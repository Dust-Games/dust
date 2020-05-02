# Dust

## Installation guide is [there](https://github.com/kaizzzoku/dust/blob/master/installation.md)
## Some helpful commands:
#### PostgreSql Dump:                                                                            
```                                                                                             
sudo -u postgres pg_dump dust > dust.bak                                                       
```                                                                                             
#### Copy backup to Docker container:                                                            
```                                                                                             
docker exec -i dust_db bash -c 'cat > dust.bak' < dust.bak                                      
```      
