# Exemplo PHP - Catálogo Web Ideia 2001

Este exemplo demonstra como implementar a renderização do Catálogo Web da Ideia 2001 em PHP usando Apache.

## 📋 Visão Geral

O exemplo inclui:
- ✅ Configuração Docker para desenvolvimento local
- ✅ Implementação da API de renderização em PHP
- ✅ Suporte multi-idioma (pt/en/es)
- ✅ Integração com framework frontend (Vue.js como exemplo)
- ✅ Estrutura de rotas completa

## 🚀 Como Executar

### 1. Configurar Variáveis de Ambiente

Crie um arquivo `.env.local` baseado no `.env` com suas credenciais:

```bash
CATALOGO=seu-nome-catalogo
CHAVE_PERFIL=sua-chave-api
CHAVE_SECRETA=sua-chave-secreta
```

> **Importante:** Essas credenciais são fornecidas pela Ideia 2001 na entrega do catálogo.

### 2. Fazer Build da Imagem Docker

```shell
docker build -t catalogo_web_client_php_test .
```

### 3. Executar o Container

```shell
docker run --env-file .env.local -p 8080:80 -v ./render:/var/www/html catalogo_web_client_php_test:latest
```

### 4. Acessar o Exemplo

Abra o navegador em: `http://localhost:8080`

## 📁 Estrutura do Projeto

```
render/
├── index.php          # Página inicial
├── requestAPI.php     # Lógica de requisição à API
├── shared.php         # Template HTML compartilhado
├── pt/                # Páginas em português
│   ├── index.php
│   ├── informativos/
│   └── produto/
├── en/                # Páginas em inglês
│   ├── index.php
│   ├── informativos/
│   └── produto/
└── es/                # Páginas em espanhol
    ├── index.php
    ├── informativos/
    └── produto/
```

## 🔧 Arquivos Principais

### `requestAPI.php`
Contém a função `cw_render()` que:
- Configura as credenciais da API
- Detecta o idioma (via pathname ou cookie)
- Faz a requisição para a API da Ideia 2001
- Retorna o conteúdo renderizado

### `shared.php`
Template HTML que:
- Inclui os metadados SEO no `<head>`
- Integra o conteúdo do catálogo ao layout do site
- Mantém header e footer personalizados

## 🌐 Suporte Multi-idioma

**A implementação do multi-idioma fica a critério do desenvolvedor**, desde que o idioma correto seja enviado para a API da Ideia 2001 através do parâmetro `idioma`.

Este exemplo demonstra algumas estratégias possíveis:

### 1. Via Pathname (Implementado neste exemplo)
```
/pt/produtos → idioma=pt
/en/produtos → idioma=en
/es/produtos → idioma=es
```

### 2. Via Cookie (Código disponível em `requestAPI.php`)
```php
function obtemCookieIdioma() {
    return $_COOKIE['idioma'] ?? 'pt';
}
```

### 3. Idioma Fixo (Exemplo mais simples)
```php
$idm = 'pt'; // Português como padrão
```

> **Importante:** Independente da estratégia escolhida, o valor final deve ser enviado no parâmetro `idioma` da requisição para a API da Ideia 2001.

## 🛠️ Personalização

### Alterando o Layout

Edite o arquivo `shared.php` para customizar:
- Header do site
- Footer do site
- Estrutura HTML geral
- Integração com outros frameworks JS

### Adicionando Novas Rotas

1. Crie novos arquivos PHP nas pastas de idioma
2. Inclua `requestAPI.php` e `shared.php`
3. Configure o pathname correspondente

Exemplo para nova rota `/contato`:
```php
<?php
require '../requestAPI.php';
include '../shared.php';
?>
```

### Configurando Diferentes Ambientes

Para diferentes ambientes (desenvolvimento, produção), ajuste as variáveis:

```bash
# Desenvolvimento
CATALOGO=catalogo-dev
CHAVE_PERFIL=chave-dev
CHAVE_SECRETA=secreta-dev

# Produção
CATALOGO=catalogo-prod
CHAVE_PERFIL=chave-prod
CHAVE_SECRETA=secreta-prod
```

## 📝 Exemplo de Requisição

Quando o usuário acessa `/pt/produto?id=123`, a requisição para a API fica:

```
GET https://catalogoexpresso.com.br/ideia2001/render/v2/?retornoJson=1&catalogo=SEU_CATALOGO&chavePerfil=SUA_CHAVE&chaveSecreta=SUA_SECRETA&pathname=/produto&idioma=pt&id=123
```

## 🔒 Segurança

- ✅ Chave secreta fica apenas no servidor (via variável de ambiente)
- ✅ HTTPS configurado no Docker
- ✅ Validação de parâmetros de entrada
- ✅ Headers de segurança configurados no Apache

## 🐛 Troubleshooting

### Erro 500 - Internal Server Error
- Verifique se o arquivo `.env.local` existe e está configurado
- Confirme se as credenciais estão corretas

### Conteúdo não aparece
- Verifique a conectividade com `catalogoexpresso.com.br`
- Confirme se as rotas estão configuradas corretamente na Ideia 2001

### Problemas de encoding
- Certifique-se que todos os arquivos estão em UTF-8
- Verifique a configuração de charset no Apache
