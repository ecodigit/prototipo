# Ecodigit Prototipo WP4

### How to run it

In the following examples port 5000 is used to expose the site.
Any other available port can be used.

##### Locally (suggested for development)

- Install PHP (if not already installed)
  https://www.php.net/

- Install Composer Locally (if not already installed)
`./bin/installComposer.sh`

- Run Composer (use global command if composer already installed)
`php composer.phar install`

- Enable auto-build
  `./bin/buildWatch.sh` (CTRL-C to quit)

- In a new shell, set system environment variable pointing to the SPARQL endpoint
  `export CONFIG_SPARQL_ENDPOINT_URL=http://150.146.207.67/sparql/ds`

- Start HTTP server (in the same shell)
  `./bin/serve.sh 5000` (CTRL-C to quit)

##### As docker container

- Build image:
  `docker build -t prototipo .`
- Run image (create container and start it):
  `docker run -p 127.0.0.1:5000:80/tcp -e CONFIG_SPARQL_ENDPOINT_URL=http://150.146.207.67/sparql/ds -d --name prototipo prototipo`
- Stop container:
  `docker stop prototipo`
- Start container:
  `docker start prototipo`

### Code description (ITA)

Il file index.php contiene un campo di ricerca testuale e le opzioni per la selezione delle categorie e delle tipologie
Lo script search_sparql.php effettua la ricerca dei risultati sul server sparql
Lo script showr_on_map.php visulizza i risultati su mappa OpenLayers
