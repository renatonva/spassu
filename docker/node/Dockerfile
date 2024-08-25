# Use uma imagem oficial do Node.js como imagem base
FROM node:16

# Defina o diretório de trabalho dentro do container
WORKDIR /var/www

# Copie todo o código do projeto para o container
COPY ../../package*.json ./

# Instale as dependências do projeto
RUN npm install

# Construa o projeto Vite
RUN npm run build

# Instale um servidor estático como o 'serve' para servir os arquivos
RUN npm install -g serve

# Exponha a porta que o app vai rodar
EXPOSE 5173

# Comando para servir os arquivos estáticos
CMD ["serve", "-s", "dist"]