import sys
import requests
import json


def main(args):
    upload_server = args.pop(0)

    for arg in args:
        response = requests.post(upload_server, files={"file": open(arg, "rb")})

        res = json.loads(response.text)
        if res['status'] == 200 or res['status'] == -3:
            print(res['src'])

    return 0


if __name__ == '__main__':
    main(sys.argv[1:])
