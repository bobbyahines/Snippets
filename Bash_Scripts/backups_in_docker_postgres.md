# Backing Up Postgres in Docker

This is effective because the /srv/backups folder is volumed into the container for persistance.

```shell
#!/usr/bin/env bash

docker exec -it docker-postgres-db /bin/bash -c "cd /srv/backups && \
  pg_dump -U {DB_USER} {DB_NAME} > database-name_$(date +'%Y-%m-%d').sql && \
  tar -czvf database-name_$(date +'%Y-%m-%d').tar.gz database-name_$(date +'%Y-%m-%d').sql && \
  rm -f database-name_$(date +'%Y-%m-%d').sql"
wait

cd /home/{OS_USER}/prod-stack/backups && \
  rsync --progress -e "ssh -i /home/{OS_USER}/.ssh/private_key" -av database-name_$(date +'%Y-%m-%d').tar.gz {BACKUP_SERVER_USER}@{BACKUP_SERVER_IP}:/directory/to/store/in
wait

cd /home/conan/prod-wa-belit-api/devops
```
