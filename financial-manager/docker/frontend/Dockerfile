# Build stage
FROM node:20-alpine AS builder

WORKDIR /app

# Primeiro copia apenas os arquivos necessários para instalar dependências
COPY frontend/package*.json ./

# Instala dependências
RUN npm install --legacy-peer-deps

# Copia o resto do código fonte
COPY frontend/ ./

# Build da aplicação
RUN npm run build

# Production stage
FROM nginx:alpine

# Copia configuração do nginx
COPY docker/frontend/nginx.conf /etc/nginx/conf.d/default.conf

# Copia os arquivos buildados
COPY --from=builder /app/dist /usr/share/nginx/html

# Expose port 80
EXPOSE 80

# Start nginx
CMD ["nginx", "-g", "daemon off;"]
