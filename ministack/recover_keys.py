import boto3
import json
from botocore.exceptions import ClientError

iam = boto3.client(
    'iam',
    endpoint_url='http://localhost:4566',
    aws_access_key_id='test',
    aws_secret_access_key='test',
    region_name='us-east-1'
)

def recover_keys(username):
    try:
        # Cek apakah user ada
        try:
            iam.get_user(UserName=username)
        except ClientError:
            print(f"❌ User '{username}' tidak ditemukan!")
            return

        # Hapus keys lama kalau ada
        existing = iam.list_access_keys(UserName=username)
        for key in existing['AccessKeyMetadata']:
            iam.delete_access_key(
                UserName=username,
                AccessKeyId=key['AccessKeyId']
            )
            print(f"🗑️  Keys lama dihapus")

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

        print(f"\n✅ Keys berhasil di-recover untuk '{username}'!")
        print(f"🔑 Access Key : {access_key}")
        print(f"🔒 Secret Key : {secret_key}")
        print(f"💾 Tersimpan di: keys_{username}.json")

    except ClientError as e:
        print(f"❌ Error: {e}")

# ---- MAIN ----
if __name__ == "__main__":
    print("=" * 40)
    print("        RECOVER KEYS PENGGUNA")
    print("=" * 40)
    username = input("Masukkan username yang ingin di-recover: ")
    
    if not username.strip():
        print("❌ Username tidak boleh kosong!")
    else:
        recover_keys(username)