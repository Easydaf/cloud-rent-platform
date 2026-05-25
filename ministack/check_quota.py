import boto3
from botocore.exceptions import ClientError

s3 = boto3.client(
    's3',
    endpoint_url='http://localhost:4566',
    aws_access_key_id='test',
    aws_secret_access_key='test',
    region_name='us-east-1'
)

# Paket langganan (sesuai spesifikasi minimal 3 paket)
PAKET = {
    "basic"    : 1 * 1024 * 1024 * 1024,   # 1 GB
    "standard" : 5 * 1024 * 1024 * 1024,   # 5 GB
    "premium"  : 20 * 1024 * 1024 * 1024,  # 20 GB
}

def format_ukuran(bytes):
    if bytes < 1024:
        return f"{bytes} B"
    elif bytes < 1024 ** 2:
        return f"{bytes / 1024:.2f} KB"
    elif bytes < 1024 ** 3:
        return f"{bytes / (1024 ** 2):.2f} MB"
    else:
        return f"{bytes / (1024 ** 3):.2f} GB"

def buat_progress_bar(terpakai, total, panjang=30):
    persen = terpakai / total if total > 0 else 0
    filled = int(panjang * persen)
    bar = "█" * filled + "░" * (panjang - filled)
    return f"[{bar}] {persen * 100:.1f}%"

def cek_quota(username, paket="basic"):
    nama_bucket = f"bucket-{username.lower()}"

    try:
        # Cek apakah bucket ada
        s3.head_bucket(Bucket=nama_bucket)
    except ClientError:
        print(f"❌ Bucket untuk '{username}' tidak ditemukan!")
        return

    try:
        # Hitung total ukuran file di bucket
        response = s3.list_objects_v2(Bucket=nama_bucket)
        files = response.get('Contents', [])

        total_terpakai = sum(f['Size'] for f in files)
        total_kuota = PAKET.get(paket.lower(), PAKET['basic'])
        sisa_kuota = total_kuota - total_terpakai

        print("\n" + "=" * 50)
        print(f"       INFORMASI KUOTA - {username.upper()}")
        print("=" * 50)
        print(f"📦 Paket       : {paket.upper()}")
        print(f"💾 Total Kuota : {format_ukuran(total_kuota)}")
        print(f"📊 Terpakai    : {format_ukuran(total_terpakai)}")
        print(f"✅ Sisa Kuota  : {format_ukuran(sisa_kuota)}")
        print(f"\n{buat_progress_bar(total_terpakai, total_kuota)}")

        # Tampilkan daftar file
        if files:
            print(f"\n📁 File di bucket ({len(files)} file):")
            for f in files:
                print(f"   - {f['Key']} ({format_ukuran(f['Size'])})")
        else:
            print(f"\n📭 Bucket masih kosong")

        # Peringatan kalau kuota hampir habis
        persen_terpakai = (total_terpakai / total_kuota) * 100
        if persen_terpakai >= 90:
            print(f"\n⚠️  PERINGATAN: Kuota hampir habis!")
        elif persen_terpakai >= 70:
            print(f"\n⚠️  Kuota sudah terpakai lebih dari 70%")

        print("=" * 50)

    except ClientError as e:
        print(f"❌ Error: {e}")

# ---- MAIN ----
if __name__ == "__main__":
    print("=" * 50)
    print("           CEK KUOTA PENGGUNA")
    print("=" * 50)

    username = input("Masukkan username: ")

    if not username.strip():
        print("❌ Username tidak boleh kosong!")
    else:
        print("\nPilih paket:")
        print("  1. Basic    (1 GB)")
        print("  2. Standard (5 GB)")
        print("  3. Premium  (20 GB)")

        pilihan = input("\nMasukkan pilihan (1/2/3): ")

        paket_map = {"1": "basic", "2": "standard", "3": "premium"}
        paket = paket_map.get(pilihan, "basic")

        cek_quota(username, paket)