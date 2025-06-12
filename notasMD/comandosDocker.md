## Comandos básicos y necesarios para Docker

### Contenedores

- `docker ps`  
  Lista los contenedores en ejecución.

- `docker ps -a`  
  Lista todos los contenedores (incluidos los detenidos).

- `docker stop <nombre_o_id>`  
  Detiene un contenedor.

- `docker start <nombre_o_id>`  
  Inicia un contenedor detenido.

- `docker restart <nombre_o_id>`  
  Reinicia un contenedor.

- `docker rm <nombre_o_id>`  
  Elimina un contenedor detenido.

### Imágenes
- `docker images`  
  Lista las imágenes descargadas.

- `docker rmi <id_imagen>`  
  Elimina una imagen.

### Volúmenes
- `docker volume ls`  
  Lista los volúmenes.

- `docker volume rm <nombre_volumen>`  
  Elimina un volumen.

### Docker Compose
- `docker-compose up`  
  Levanta los servicios definidos en docker-compose.yml.

- `docker-compose up --build`  
  Levanta y reconstruye los servicios.

- `docker-compose down`  
  Detiene y elimina los contenedores, redes y volúmenes temporales.

- `docker-compose ps`  
  Lista los servicios activos de Compose.

### Otros útiles
- `docker logs <nombre_o_id>`  
  Muestra los logs de un contenedor.
  
- `docker exec -it <nombre_o_id> bash`  
  Entra a la terminal de un contenedor en ejecución.

