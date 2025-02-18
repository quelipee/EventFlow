# To-Do List: Sistema de Eventos

## Páginas Essenciais (Mínimo para CLT)

### 1. **Página de Cadastro de Usuário**
- [x] Criar formulário de registro com campos essenciais (nome, e-mail, senha).
- [x] Implementar validação de dados no frontend e backend.
- [x] Criar rota e controlador para cadastro de novos usuários.
- [ ] Enviar e-mail de confirmação após cadastro (opcional).

### 2. **Página de Login**
- [x] Criar formulário de login com campos para e-mail e senha.
- [x] Implementar autenticação no backend (login, sessões ou JWT).
- [x] Criar mensagens de erro (usuário ou senha incorretos).
- [ ] Adicionar funcionalidade "Lembrar de mim" (opcional).

### 3. **Página Principal (Dashboard/Calendário)**
- [x] Exibir eventos do usuário em um calendário interativo.

### 4. **Página de Adicionar Evento**
- [x] Criar formulário para adicionar novos eventos (título, data, hora, descrição, etc.).
- [x] Implementar validação de dados do evento.
- [x] Adicionar campo para definir a duração do evento (opcional).

### 5. **Página de Editar Evento**
- [x] Criar formulário para edição de eventos existentes.
- [x] Pré-preencher os campos com os dados do evento atual.
- [x] Implementar validação de dados e atualização no banco de dados.

### 6. **Página de Listagem de Eventos**
- [x] Exibir lista de eventos cadastrados pelo usuário.
- [ ] Adicionar funcionalidade de filtragem e ordenação de eventos (por data, título, etc.).
- [x] Permitir a visualização rápida dos detalhes de cada evento.

### 7. **Página de Remover Evento (ou Modal de Confirmação)**
- [x] Criar funcionalidade para remover um evento.
- [x] Adicionar um modal de confirmação antes de excluir o evento.
- [x] Excluir o evento do banco de dados após confirmação.

---

## Páginas Adicionais (Funcionalidades Extras)

### 8. **Página de Convites de Eventos**
- [ ] Exibir eventos aos quais o usuário foi convidado.
- [ ] Permitir que o usuário aceite ou recuse os convites.
- [ ] Atualizar o status do convite no banco de dados.

### 9. **Página de Gerenciamento de Usuários (Admin)**
- [ ] Exibir lista de usuários para admins.
- [ ] Adicionar funcionalidades para criar, editar ou remover usuários.
- [ ] Definir permissões e papéis de usuários (ex: admin, usuário comum).

### 10. **Página de Alertas/Conflitos de Eventos**
- [ ] Implementar sistema de alerta para conflitos de horário entre eventos.
- [ ] Exibir notificação de conflito quando o usuário tentar agendar um evento em um horário já ocupado.
- [ ] Oferecer a opção de editar ou excluir o evento em conflito.
