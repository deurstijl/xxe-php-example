# XXE example for testing
based on https://github.com/fl0rde/xxe-challenge  

It used a docx file to deliver the payload.

## Installation:

### For use on a barebone:
```
sudo apt update
apt install -y docker.io git
git clone https://github.com/deurstijl/xxe-php-example.git
```

### Open the folder that contains the dockerfile
* run `docker build -t xxe_php . `
* For running at port 8080 we use `docker run -p 8080:80 xxe_php`
* For an interactive shell: `docker run -ti -p 8080:80 xxe_php /bin/bash` and start apache with: `apachectl -DFOREGROUND`

### Stop container:
* Use `docker ps` to copy the hash of the running container
* `docker stop` to stop the container
