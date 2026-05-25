import boto3
import os
import json
from botocore.exceptions import ClientError

iam = boto3.client(
    'iam',
    endpoint_url='http://localhost:4566',
    aws_access_key_id='test',
    aws_secret_access_key='test',
    region_name='us-east-1'
)

def lihat_semua_user():
    try:
        response = iam.list_users()
        users = response['Users']

        if not users:
            print("⚠️  Belum ada user yang terdaftar.")
            return

        print("=" * 50)
        print("          DAFTAR SEMUA PENGGUNA")
        print("=" * 50)

        for user in users:
            username = user['UserName']
            print(f"\n👤 Username : {username}")

            # Cek keys di IAM
            keys = iam.list_access_keys(UserName=username)
            key_list = keys['AccessKeyMetadata']

            if key_list:
                print(f"🔑 Status Keys : ✅ Ada ({len(key_list)} key)")
                for k in key_list:
                    print(f"   Access Key : {k['AccessKeyId']}")
                    print(f"   Status     : {k['Status']}")
            else:
                print(f"🔑 Status Keys : ❌ Belum ada / Gagal generate")

            # Cek file JSON tersimpan atau tidak
            json_path = f"D:/Project_Cloud/project-ministack/keys_{username}.json"
            if os.path.exists(json_path):
                print(f"💾 File JSON   : ✅ Tersimpan")
                with open(json_path) as f:
                    data = json.load(f)
                    print(f"   Access Key : {data['access_key']}")
                    print(f"   Secret Key : {data['secret_key']}")
            else:
                print(f"💾 File JSON   : ❌ Tidak ditemukan")

            print("-" * 50)

    except ClientError as e:
        print(f"❌ Error: {e}")

# ---- MAIN ----
if __name__ == "__main__":
    lihat_semua_user()