# import the required libraries
from http.server import BaseHTTPRequestHandler, HTTPServer
import json
import base64
import os

HOST = "0.0.0.0"
PORT = 3000

USERNAME = "test"
PASSWORD = "abcABC123"

def get_users():
  users = {}
  with open("/etc/passwd", "r") as f:
    for line in f:
      parts = line.strip().split(":")
      uid = parts[2]
      name = parts[0]
      users[uid] = name
    return users

def get_groups():
  groups = {}
  with open("/etc/group", "r") as f:
    for line in f :
      parts = line.strip().split(":")
      gid = parts[2]
      name = parts[0]
      groups[gid] = name
  return groups

class APIHandler(BaseHTTPRequestHandler):

  def do_POST(self):
    if not self.authenticate():
      return

    if self.path == "/api/users":
      self.respond_json(get_users())
    elif self.path == "/api/groups":
      self.respond_json(get_groups())
    else:
      self.send_response(404)
      self.end_headers()
      self.wfile.write(b"Not Found")

  def authenticate(self):
    auth = self.headers.get("Authorization")
    if auth is None:
      self.request_auth()
      return False

    try:
      scheme, encoded = auth.split(" ", 1)
      if scheme != "Basic":
        self.request_auth()
        return False

      decoded = base64.b64decode(encoded).decode("utf-8")
      username, password = decoded.split(":", 1)

    except Exception:
      self.request_auth()
      return False


    if username == USERNAME and password == PASSWORD:
      return True

    self.request_auth()
    return False

  def request_auth(self):
    self.send_response(401)
    self.send_header("WWW-Authenticate", 'Basic realm="API"')
    self.end_headers()

  def respond_json(self, data):
    response = json.dumps(data).encode("utf-8")
    self.send_response(200)
    self.send_header("Content-Type", "application/json")
    self.send_header("Content-Length", str(len(response)))
    self.end_headers()
    self.wfile.write(response)

if __name__ == "__main__":
  server = HTTPServer((HOST, PORT), APIHandler)
  print(f"Listening on http://{HOST}:{PORT}")
  server.serve_forever()

