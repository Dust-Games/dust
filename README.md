# Dust
### PostgreSql Dump:                                                                            
```                                                                                             
sudo -u postgres pg_dump dust > dust.bak                                                       
```                                                                                             
### Copy backup to Docker container:                                                            
```                                                                                             
docker exec -i dust_db bash -c 'cat > dust.bak' < dust.bak                                      
```      
