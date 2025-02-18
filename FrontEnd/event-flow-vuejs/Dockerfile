FROM node:18-alpine
RUN npm install -g @vue/cli

# Define o diretório de trabalho
WORKDIR /app

# Copia o package.json e package-lock.json (se existir)
COPY package*.json ./

# Instala as dependências do projeto (incluindo o Vue CLI)
RUN npm install

RUN npm ci --prefer-offline --no-audit --progress=false

# Copia o restante do código do projeto
COPY . .

# Expõe a porta para o servidor
EXPOSE 8080

# Comando para rodar o app
CMD ["npm", "run", "dev"]

