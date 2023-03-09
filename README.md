
  # swarm01 apache-php
### Ref awaresome-compose
- [docker/awesome-compose/apache-php](https://github.com/docker/awesome-compose/tree/master/apache-php)
### Wakatime Project
- [@spcn10/swarm01](https://wakatime.com/@spcn10/projects/otxagdylnv?start=2023-02-27&end=2023-03-05)
### URL-DEPLOY
- https://spcn10php.xops.ipv9.me/
## Setup-Linux
1. Set เวลา โดยใช้คำสั่ง
	```
	sudo time datectl set-timezone Asia/Bangkok 
	```
2. Set ชื่อ Hostname
    ```
	sudo hostnamectl set-hostname **hostname**
	```
3. เปลี่ยนแปลง Machine-ID
	  ```
	rm /var/lib/dbus/machine-id
	echo -n > /etc/machine-id
	cat /etc/machine-id
	ln -s /etc/machine-id /var/lib/dbus/machine-id
	```
## Install-Docker on Linux
1. คำสั่งที่ใช้ลง Docker
	```
	apt update; apt upgrade -y #update packet
	apt-get install ca-certificates curl wget gnupg lsb-release -y #install packet
	mkdir -m 0755 -p /etv/apt/keyrings
	
	curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --dearmor -o /etc/apt/keyrings/docker.gpg #Download packet Docker
	echo \ "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \ $(lsb_release -cs) stable" |  tee /etc/apt/sources.list.d/docker.list > /dev/null
	
	apt-get update #update file packet give can install
	apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin -y #install Docker

	<Then> reboot

2. คำสั่งตรวจสอบการใช้งาน Docker
	```
	sudo docker run hello-world
	```
## Build-Image & Tag
1. คำสั่งการ Build image
	 ```
	sudo docker compose "fastapi/compose.yaml" up -d --build
	```
2. คำสั่งการ Tag
	 ```
	docker tag SOURCE_IMAGE[:TAG] TARGET_IMAGE[:TAG]
	```
## Push Image To Docker Hub
1.   คำสั่งเข้าสู่ระบบ Docker ใน Vscode
		```
		docker login
		```
2.   คำสั่ง Push Image To Docker Hub
		```
		docker push TARGET_IMAGE[:TAG]
		```
## Create Stack Deploy
1. สร้างไฟล์ docker-compose.yaml
```
services:
  web:
    build:
      context: app
      target: dev-envs
    ports: 
      - '80:80'
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - ./app:/var/www/html/
```
2. ให้ docker-compose.yaml ไป Stack Deploy on local โดยคำสั่ง
	```
	docker compose up -d --build
	```
3. ตรวจสอบการใช้งานให้พิมพ์ Ip mechine:80 บน Web Browser
	
## Swarm Cluster
### Revert Proxy 
- Revert Proxy File docker-compose-RevProxy.yaml on website Edit For stack on portainer.ipv9.me
```
version: '3.3'
services:
  web:
    image: TARGET_IMAGE[:TAG]
    networks:
     - webproxy
    logging:
      driver: json-file
    volumes:
      - app:/var/www/html/
    container_name: swarm01-web2
    deploy:
      replicas: 1
      labels:
        - traefik.docker.network=webproxy
        - traefik.enable=true
        - traefik.http.routers.${APPNAME}-https.entrypoints=websecure
        - traefik.http.routers.${APPNAME}-https.rule=Host("${APPNAME}.xops.ipv9.me")
        - traefik.http.routers.${APPNAME}-https.tls.certresolver=default
        - traefik.http.services.${APPNAME}.loadbalancer.server.port=80
      resources:
        reservations:
          cpus: '0.1'
          memory: 10M
        limits:
          cpus: '0.4'
          memory: 50M
networks:
  webproxy:
    external: true
volumes:
  app:

```
	## Result 
    ![image](https://user-images.githubusercontent.com/117428887/224103694-341e5c76-db3b-4418-9bb6-ef794059ed72.png)