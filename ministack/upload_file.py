import boto3
import os
from botocore.exceptions import ClientError

s3 = boto3.client(
    's3',
    endpoint_url='http://localhost:4566',
    aws_access_key_id='test',
    aws_secret_access_key='test',
    region_name='us-east-1'
)

# Batas ukuran upload per paket
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

def cek_sisa_kuota(username, paket):
    nama_bucket = f"bucket-{username.lower()}"
    response = s3.list_objects_v2(Bucket=nama_bucket)
    files = response.get('Contents', [])
    total_terpakai = sum(f['Size'] for f in files)
    total_kuota = PAKET.get(paket.lower(), PAKET['basic'])
    return total_kuota - total_terpakai

def upload_file(username, path_file, paket="basic"):
    nama_bucket = f"bucket-{username.lower()}"

    # Cek file ada atau tidak
    if not os.path.exists(path_file):
        print(f"❌ File '{path_file}' tidak ditemukan!")
        return

    # Cek ukuran file
    ukuran_file = os.path.getsize(path_file)
    nama_file = os.path.basename(path_file)

    try:
        # Cek bucket ada atau tidak
        s3.head_bucket(Bucket=nama_bucket)
    except ClientError:
        print(f"❌ Bucket untuk '{username}' tidak ditemukan!")
        return

    # Cek sisa kuota
    sisa_kuota = cek_sisa_kuota(username, paket)

    print("\n" + "=" * 50)
    print(f"          UPLOAD FILE - {username.upper()}")
    print("=" * 50)
    print(f"📄 File      : {nama_file}")
    print(f"📦 Ukuran    : {format_ukuran(ukuran_file)}")
    print(f"✅ Sisa Kuota: {format_ukuran(sisa_kuota)}")

    # Cek apakah kuota cukup
    if ukuran_file > sisa_kuota:
        print(f"\n❌ Upload gagal! Kuota tidak cukup!")
        print(f"   File  : {format_ukuran(ukuran_file)}")
        print(f"   Sisa  : {format_ukuran(sisa_kuota)}")
        return

    try:
        print(f"\n⏳ Mengupload '{nama_file}'...")
        s3.upload_file(path_file, nama_bucket, nama_file)
        print(f"✅ File '{nama_file}' berhasil diupload!")
        print(f"📍 Lokasi: {nama_bucket}/{nama_file}")
        print(f"💾 Sisa kuota setelah upload: {format_ukuran(sisa_kuota - ukuran_file)}")
        print("=" * 50)

    except ClientError as e:
        print(f"❌ Gagal upload: {e}")

def lihat_file_bucket(username):
    nama_bucket = f"bucket-{username.lower()}"
    try:
        response = s3.list_objects_v2(Bucket=nama_bucket)
        files = response.get('Contents', [])

        print(f"\n📁 File milik '{username}' ({len(files)} file):")
        if files:
            for f in files:
                print(f"   - {f['Key']} ({format_ukuran(f['Size'])})")
        else:
            print("   📭 Bucket masih kosong")
    except ClientError as e:
        print(f"❌ Error: {e}")

def hapus_file(username, nama_file):
    nama_bucket = f"bucket-{username.lower()}"
    try:
        s3.delete_object(Bucket=nama_bucket, Key=nama_file)
        print(f"✅ File '{nama_file}' berhasil dihapus!")
    except ClientError as e:
        print(f"❌ Gagal hapus file: {e}")

# ---- MAIN ----
if __name__ == "__main__":
    print("=" * 50)
    print("           MANAJEMEN FILE BUCKET")
    print("=" * 50)

    username = input("Masukkan username: ")

    if not username.strip():
        print("❌ Username tidak boleh kosong!")
    else:
        print("\nMenu:")
        print("  1. Upload file ke bucket")
        print("  2. Lihat file di bucket")
        print("  3. Hapus file dari bucket")

        pilihan = input("\nPilih menu (1/2/3): ")

        if pilihan == "1":
            print("\nPaket langganan:")
            print("  1. Basic    (1 GB)")
            print("  2. Standard (5 GB)")
            print("  3. Premium  (20 GB)")
            paket_pilihan = input("Pilih paket (1/2/3): ")
            paket_map = {"1": "basic", "2": "standard", "3": "premium"}
            paket = paket_map.get(paket_pilihan, "basic")

            path_file = input("Masukkan path file yang ingin diupload\n(contoh: D:/dokumen/file.txt): ")
            upload_file(username, path_file, paket)

        elif pilihan == "2":
            lihat_file_bucket(username)

        elif pilihan == "3":
            lihat_file_bucket(username)
            nama_file = input("\nMasukkan nama file yang ingin dihapus: ")
            konfirmasi = input(f"Yakin hapus '{nama_file}'? (ya/tidak): ")
            if konfirmasi.lower() == "ya":
                hapus_file(username, nama_file)
            else:
                print("❌ Penghapusan dibatalkan!")
        else:
            print("❌ Pilihan tidak valid!")