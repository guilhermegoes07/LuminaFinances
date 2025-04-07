# Build stage
FROM node:20 AS builder

WORKDIR /app

# Copia apenas os arquivos necessários para instalar dependências
COPY backend/package*.json ./
COPY backend/prisma ./prisma

# Instala dependências e gera o cliente Prisma
RUN npm install && npx prisma generate

# Copia o resto do código fonte
COPY backend/ ./

# Build da aplicação
RUN npm run build

# Production stage
FROM node:20

WORKDIR /app

# Copia apenas os arquivos necessários para produção
COPY --from=builder /app/dist ./dist
COPY --from=builder /app/node_modules ./node_modules
COPY --from=builder /app/package*.json ./

EXPOSE 3000

CMD ["node", "dist/server.js"]
