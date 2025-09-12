
# 🦅 Projeto Laravel + Vue.js com Docker

[![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)](https://laravel.com/)  
[![Vue.js](https://img.shields.io/badge/Vue-3-42b883?logo=vue.js)](https://vuejs.org/)  
[![MySQL](https://img.shields.io/badge/MySQL-8.0-blue?logo=mysql)](https://www.mysql.com/)  
[![Redis](https://img.shields.io/badge/Redis-7-orange?logo=redis)](https://redis.io/)  
[![Docker](https://img.shields.io/badge/Docker-24-blue?logo=docker)](https://www.docker.com/)

---

## 📝 Descrição

Aplicação **fullstack** Laravel + Vue.js, totalmente **containerizada**.  
Suporte a **queues**, **scheduler**, **cache Redis**, **MySQL** e **Mailhog**, pronta para desenvolvimento rápido e escalável.

Principais funcionalidades:

- API REST com Laravel  
- Frontend Vue.js com hot-reload  
- Fila de jobs e scheduler Laravel em containers separados  
- Banco MySQL e cache Redis  
- Teste de e-mails via Mailhog  
- Totalmente Dockerizado  

---

## 📦 Containers & Serviços

| Serviço       | Imagem / Build           | Porta       | Função                                       |
|---------------|------------------------|------------|---------------------------------------------|
| db            | mysql:8.0              | 3306       | Banco de dados                               |
| redis         | redis:7-alpine         | 6379       | Cache e filas                                |
| mailhog       | mailhog/mailhog:v1.0.1 | 8025/1025  | Testes de e-mail                             |
| backend       | ./backend              | 8000       | API Laravel                                  |
| queue         | ./backend              | -          | Worker da fila de jobs (container separado) |
| scheduler     | ./backend              | -          | Agendador de tarefas (container separado)   |
| frontend      | ./frontend             | 5173       | App Vue.js (DEV hot-reload)                  |

---

## ⚡ Pré-requisitos

- Docker 24+ e Docker Compose 2+  

---

## 🚀 Executando o projeto

```bash
git clone https://github.com/seu-usuario/projeto.git
cd projeto
cp .env.example .env
# Ajuste variáveis de ambiente no .env
docker-compose up -d --build
```

Acesse os serviços:

- **Backend API:** http://localhost:8000  
- **Frontend Vue.js:** http://localhost:5173  
- **Mailhog UI:** http://localhost:8025  
- **MySQL:** localhost:3306  
- **Redis:** localhost:6379  
- **Fila de jobs:** via container `queue`  
- **Scheduler de tarefas:** via container `scheduler`  

---

## 🔧 Comandos úteis

**Backend (API):**

```bash
docker-compose exec backend php artisan migrate
docker-compose exec backend php artisan db:seed
```

**Fila de jobs (container `queue`):**

```bash
docker-compose exec queue php artisan queue:work
```

**Scheduler (container `scheduler`):**

```bash
docker-compose exec scheduler php artisan schedule:work
```

**Frontend:**

```bash
docker-compose exec frontend npm install
docker-compose exec frontend npm run dev
```

**Logs:**

```bash
docker-compose logs -f backend
docker-compose logs -f queue
docker-compose logs -f scheduler
docker-compose logs -f frontend
```

---

## ⚠️ Pontos de atenção

- Logs ainda não centralizados; atualmente apenas no console dos containers  
- Scheduler e queues configurados para DEV; ajustar supervisor/systemd para produção  
- Hot-reload do frontend é apenas para desenvolvimento; build para produção é necessário  
- Backup periódico de MySQL e Redis recomendado  

---

## 💡 Melhorias futuras

- Centralização de logs e observabilidade (ELK, Grafana + Loki)  
- CI/CD para builds automáticos de backend e frontend  
- SSL/TLS local para testes seguros  
- Testes automatizados end-to-end  
- Otimização de Dockerfiles para reduzir build time  

---

## 📝 Considerações do Projeto

Neste projeto, aprofundei bastante meus conhecimentos em **Laravel 12**, explorando recursos avançados e boas práticas para construção de APIs e integração com banco de dados. Consegui implementar funcionalidades complexas e demonstrar meu domínio da stack backend de forma consistente.  

No **Vue.js**, apesar de meus esforços, não consegui avançar tanto quanto gostaria para demonstrar algumas ideias diferenciadas no frontend. Ainda assim, o que foi desenvolvido serve como base sólida e reflete meu conhecimento na criação de interfaces reativas e na integração com APIs.  

Agradeço muito a oportunidade de trabalhar neste desafio e estou ansioso para mostrar mais do meu potencial, especialmente em contextos onde posso explorar tanto o backend quanto o frontend de forma mais completa.  

---

## 🔗 Links úteis

- [Laravel Docs](https://laravel.com/docs/12.x)  
- [Vue.js Docs](https://vuejs.org/guide/)  
- [MySQL Docs](https://dev.mysql.com/doc/)  
- [Redis Docs](https://redis.io/documentation)  
- [Mailhog UI](http://localhost:8025)
