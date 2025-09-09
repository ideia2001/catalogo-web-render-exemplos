# Exemplos de Renderização - Catálogo Web Ideia 2001

Este repositório contém exemplos práticos de como implementar a renderização do Catálogo Web da Ideia 2001 em diferentes linguagens de programação e frameworks.

## Como Funciona a Renderização

O Catálogo Web da Ideia 2001 utiliza **Server-Side Rendering (SSR)** para garantir que o conteúdo seja indexado corretamente pelos mecanismos de busca como o Google. A renderização é feita através de requisições para nossa API a partir do seu servidor, antes de entregar a página final para o usuário.

### Fluxo de Renderização

1. **Usuário acessa sua página** (ex: `www.empresa.com.br/produtos`)
2. **Seu servidor faz requisição** para nossa API de renderização
3. **Nossa API retorna** o conteúdo renderizado (HTML + metadados)
4. **Seu servidor integra** o conteúdo ao template da sua página
5. **Página final é entregue** ao usuário com SEO otimizado

## API de Renderização

### Endpoint
```
GET https://catalogoexpresso.com.br/ideia2001/render/v2/
```

### Parâmetros Obrigatórios

| Parâmetro | Descrição | Exemplo |
|-----------|-----------|---------|
| `retornoJson` | Sempre `1` para retorno em JSON | `1` |
| `catalogo` | Nome do seu catálogo | `empresa-pecas` |
| `chavePerfil` | Chave da API (fornecida pela Ideia 2001) | `abc123...` |
| `chaveSecreta` | Chave secreta (NUNCA expor no cliente) | `xyz789...` |
| `pathname` | Caminho da página atual | `/`, `/produtos`, `/detalhes` |
| `idioma` | Idioma do catálogo | `pt`, `en`, `es` |

### Parâmetros Dinâmicos

Todos os parâmetros da URL atual (query string) devem ser repassados para a API. Por exemplo:

**URL do usuário:**
```
https://seusite.com/produtos?filtros=linha--v--LEVE--s--fabricante--v--AUDI
```

**Requisição para API:**
```
https://catalogoexpresso.com.br/ideia2001/render/v2/?retornoJson=1&catalogo=SEU_CATALOGO&chavePerfil=SUA_CHAVE&chaveSecreta=SUA_CHAVE_SECRETA&pathname=/produtos&idioma=pt&filtros=linha--v--LEVE--s--fabricante--v--AUDI
```

### Resposta da API

A API retorna um JSON com dois campos principais:

```json
{
  "head": "<title>Título SEO</title><meta name='description' content='Descrição SEO'>...",
  "html": "<div class='catalogo-content'>Conteúdo do catálogo...</div>"
}
```

- **`head`**: Metadados para inserir no `<head>` da página (SEO)
- **`html`**: Conteúdo HTML do catálogo para inserir no corpo da página

## Implementação

### Estrutura Básica

1. **Configure as variáveis de ambiente:**
   ```
   CATALOGO=nome-do-seu-catalogo
   CHAVE_PERFIL=sua-chave-api
   CHAVE_SECRETA=sua-chave-secreta
   ```

2. **Crie uma função para fazer requisições à API**
3. **Configure as rotas necessárias** (home, produtos, detalhes, informativos)
4. **Integre o conteúdo retornado** no template da sua página

### Páginas Necessárias

As seguintes rotas são tipicamente necessárias para um catálogo completo:

- `/` - Página inicial
- `/produtos` ou `/resultado` - Listagem de produtos
- `/produto/[id]` ou `/detalhes` - Detalhes do produto
- `/informativos` - Página de informativos

> **Nota:** Os nomes das rotas podem ser personalizados conforme sua preferência, mas devem ser alinhados com a Ideia 2001 durante a configuração.

## Exemplos Disponíveis

### 📁 [`exemplos/php/`](./exemplos/php/)
Implementação completa em PHP usando Apache/XAMPP, incluindo:
- Configuração Docker para desenvolvimento
- Estrutura multi-idioma
- Exemplo de integração com Vue.js

## Suporte Multi-idioma

O catálogo suporta múltiplos idiomas. **A forma de implementar o multi-idioma fica a critério do desenvolvedor**, desde que o idioma correto seja enviado para a API da Ideia 2001 através do parâmetro `idioma`.

> **Importante:** Independente da estratégia escolhida, certifique-se de sempre enviar o parâmetro `idioma` correto na requisição para a API da Ideia 2001.

## Considerações de Segurança

⚠️ **IMPORTANTE:** 
- A `chaveSecreta` deve ficar **APENAS** no seu servidor
- **NUNCA** exponha a chave secreta no código cliente (JavaScript)
- Use HTTPS em produção
- Valide e sanitize todos os parâmetros recebidos

## Configuração e Entrega

Durante a entrega do catálogo, a Ideia 2001 fornecerá:

- ✅ Nome do catálogo
- ✅ Chave da API (`chavePerfil`)
- ✅ Chave secreta (`chaveSecreta`)
- ✅ Configuração das rotas personalizadas
- ✅ Idiomas disponíveis
- ✅ Documentação específica do seu catálogo

---

**Ideia 2001** - Catálogos inteligentes
