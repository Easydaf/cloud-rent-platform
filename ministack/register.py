import boto3
import json
from botocore.exceptions import ClientError

# Koneksi ke MiniStack
s3 = boto3.client(
    's3',
    endpoint_url='http://localhost:4566',
    aws_access_key_id='test',
    aws_secret_access_key='test',
    region_name='us-east-1'
)

iam = boto3.client(
    'iam',
    endpoint_url='http://localhost:4566',
    aws_access_key_id='test',
    aws_secret_access_key='test',
    region_name='us-east-1'
)

def buat_bucket(username):
    nama_bucket = f"bucket-{username.lower()}"
    try:
        s3.create_bucket(Bucket=nama_bucket)
        print(f"✅ Bucket '{nama_bucket}' berhasil dibuat!")
        return nama_bucket
    except ClientError as e:
        print(f"❌ Gagal buat bucket: {e}")
        return None

def generate_keys(username):
    try:
        # Coba buat user IAM, kalau sudah ada skip
        try:
            iam.create_user(UserName=username)
        except ClientError as e:
            if 'EntityAlreadyExists' in str(e):
                print(f"⚠️  User '{username}' sudah ada, generate key baru...")
            else:
                raise e
        
        # Cek apakah user sudah punya keys
        existing_keys = iam.list_access_keys(UserName=username)
        if existing_keys['AccessKeyMetadata']:
            print(f"⚠️  User '{username}' sudah punya keys!")
            key = existing_keys['AccessKeyMetadata'][0]
            print(f"   Access Key lama: {key['AccessKeyId']}")
            print(f"   (Secret Key tidak bisa ditampilkan ulang)")
            return None, None

        # Generate keys baru
        response = iam.create_access_key(UserName=username)
        key = response['AccessKey']
        
        access_key = key['AccessKeyId']
        secret_key = key['SecretAccessKey']
        
        # Simpan ke JSON
        data = {
            "username": username,
            "access_key": access_key,
            "secret_key": secret_key
        }
        with open(f"D:/Project_Cloud/project-ministack/keys_{username}.json", "w") as f:
            json.dump(data, f, indent=2)
            
        return access_key, secret_key
    
    except ClientError as e:
        print(f"❌ Gagal generate key: {e}")
        return None, None

def register():
    print("=" * 40)
    print("      REGISTRASI PENGGUNA BARU")
    print("=" * 40)
    
    # Input dari user
    username = input("Masukkan username : ")
    
    # Validasi tidak boleh kosong
    if not username.strip():
        print("❌ Username tidak boleh kosong!")
        return
    
    # Validasi tidak boleh ada spasi
    if " " in username:
        print("❌ Username tidak boleh mengandung spasi!")
        return
    
    print(f"\n⏳ Memproses registrasi '{username}'...")
    
    # Buat bucket
    bucket = buat_bucket(username)
    
    # Generate keys
    access_key, secret_key = generate_keys(username)
    
    # Tampilkan hasil
    if bucket and access_key and secret_key:
        print("\n" + "=" * 40)
        print("✅ REGISTRASI BERHASIL!")
        print("=" * 40)
        print(f"👤 Username   : {username}")
        print(f"🪣 Bucket     : bucket-{username.lower()}")
        print(f"🔑 Access Key : {access_key}")
        print(f"🔒 Secret Key : {secret_key}")
        print("=" * 40)
        print(f"💾 Keys tersimpan di: keys_{username}.json")
    else:
        print("❌ Registrasi gagal!")

# Jalankan
if __name__ == "__main__":
    register()