# 🛒 Sistema de E-commerce em PHP (POO)

## Integrantes do Grupo
- Kauan Matheus de Brito Alves — RA: 2033310  
- Wlademir Antonio Martins Junior — RA: 2042998
- Matheus Lucio Cavalcante Xavier — RA: 2038039

---

## Passo a Passo para Executar o Projeto

### 1️⃣ Clonar o repositório
```bash
git clone https://github.com/dolphin4748/projeto_gustavo.git
cd projetogustavo
```

---

### 2️⃣ Instalar dependências via Composer
Certifique-se de que o **Composer** está instalado.  
No diretório do projeto, execute:

```bash
composer install
```

---

### 3️⃣ Executar o projeto
O projeto roda em um servidor local com **XAMPP**.

1. Abra o **XAMPP** e habilite o módulo **Apache**.  
2. Mova a pasta do projeto para:
   ```
   C:/xampp/htdocs
   ```
3. No navegador, acesse:
   ```
   http://localhost/PROJETOGUSTAVO/index.php
   ```

---

## Funcionamento do Sistema

O sistema simula uma **plataforma de e-commerce** entre **Clientes** e **Vendedores**, com:

- Controle de estoque  
- Carrinho de compras  
- Contas bancárias virtuais (com depósito, saque e transferência)
- Usuários (Adm, Vendedor, Cliente)
- Adicionar, Remover promoções

---

## Classes Principais

- **Usuario** → Classe base para Cliente Vendedor e Adm (login/logout)  
- **Cliente** → Pode adicionar/remover produtos no carrinho e realizar compras  
- **Vendedor** → Pode cadastrar produtos no estoque e listar/remover itens  
- **Produto** → Representa um jogo com nome, preço, estoque e vendedor responsável  
- **ContaBancaria / ContaPagamento / ContaCorrente** → Estrutura financeira para movimentação de valores

---

## Fluxo de Execução

0. para efetuar login é apenas necessario usar uma das contas pre-definidas, "cliente@gmail.com" e "vendedor@gmail.com" com ambas tendo a senha "12345"
1. O **cliente** realiza login e deposita saldo em sua conta.  
2. O **vendedor** adiciona produtos e promoções ao estoque.  
3. O **cliente** adiciona produtos ao carrinho e lista os itens.  
4. Ao finalizar a compra:  
   - O sistema verifica o estoque disponível.  
   - Calcula o valor total.  
   - Se houver saldo suficiente, o valor é transferido para o vendedor.  
   - O estoque é atualizado e o carrinho do cliente é esvaziado.  

---

## Tecnologias Utilizadas

- **PHP 8+**  
- **Composer** (autoload de classes — PSR-4)  
- **Programação Orientada a Objetos (POO)**  

---

