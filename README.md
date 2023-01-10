# WordPress Project

Write a brief project description. Describe the overall purpose, architecture and briefly mention all bespoke functionality. Add links to relevant documentation below.

1. [Docker architecture](dockerpress.md)
2. [Setup, building and deployment](app/README.md)
3. [SWISS / Everblox theme](src/wp-content/themes/swiss/README.md)
4. Custom made plugins? Other bespoke functionality?

# Updates 2020

Docker setup has changed so you don't need the data folder anymore, you have to rebuild the project with docker-compose up --build -d
Recreate the node_modules by running npm install <-- Not anymore "em l" usage. just npm install and then you can run npm run dev.

recommended node atleast 10.16.0

You can still use em l wp search-replace for db changes
