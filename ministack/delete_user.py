import boto3
import os
import json
from botocore.exceptions import ClientError

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

def hapus_semua_file_bucket(username):
    nama_bucket = f"bucket-{username.lower()}"
    try:
        # Hapus semua file di dalam bucket dulu
        response = s3.list_objects_v2(Bucket=nama_bucket)
        files = response.get('Contents', [])

        if files:
            print(f"🗑️  Menghapus {len(files)} file di bucket...")
            for file in files:
                s3.delete_object(Bucket=nama_bucket, Key=file['Key'])
                print(f"   - {file['Key']} dihapus")
        else:
            print(f"📭 Bucket kosong, tidak ada file")

        # Hapus bucket
        s3.delete_bucket(Bucket=nama_bucket)
        print(f"✅ Bucket '{nama_bucket}' berhasil dihapus!")

    except ClientError as e:
        if 'NoSuchBucket' in str(e):
            print(f"⚠️  Bucket '{nama_bucket}' tidak ditemukan")
        else:
            print(f"❌ Gagal hapus bucket: {e}")

def hapus_keys_user(username):
    try:
        # Hapus semua access keys
        existing = iam.list_access_keys(UserName=username)
        for key in existing['AccessKeyMetadata']:
            iam.delete_access_key(
                UserName=username,
                AccessKeyId=key['AccessKeyId']
            )
        print(f"✅ Keys berhasil dihapus!")
    except ClientError as e:
        print(f"⚠️  Gagal hapus keys: {e}")

def hapus_file_json(username):
    json_path = f"D:/Project_Cloud/project-ministack/keys_{username}.json"
    if os.path.exists(json_path):
        os.remove(json_path)
        print(f"✅ File keys_{username}.json berhasil dihapus!")
    else:
        print(f"⚠️  File JSON tidak ditemukan")

def hapus_user(username):
    try:
        # Cek apakah user ada
        try:
            iam.get_user(UserName=username)
        except ClientError:
            print(f"❌ User '{username}' tidak ditemukan!")
            return

        print(f"\n⏳ Menghapus user '{username}'...")
        print("-" * 40)

        # Hapus bucket & file di dalamnya
        hapus_semua_file_bucket(username)

        # Hapus keys
        hapus_keys_user(username)

        # Hapus user IAM
        iam.delete_user(UserName=username)
        print(f"✅ User IAM '{username}' berhasil dihapus!")

        # Hapus file JSON
        hapus_file_json(username)

        print("-" * 40)
        print(f"✅ User '{username}' berhasil dihapus sepenuhnya!")

    except ClientError as e:
        print(f"❌ Error: {e}")

# ---- MAIN ----
if __name__ == "__main__":
    print("=" * 40)
    print("         HAPUS PENGGUNA")
    print("=" * 40)

    username = input("Masukkan username yang ingin dihapus: ")

    if not username.strip():
        print("❌ Username tidak boleh kosong!")
    else:
        konfirmasi = input(f"⚠️  Yakin ingin hapus '{username}'? (ya/tidak): ")
        if konfirmasi.lower() == "ya":
            hapus_user(username)
        else:
            print("❌ Penghapusan dibatalkan!")