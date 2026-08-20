# 🤖 AGENTS.md v2.0 - Framework Multi-Ambiente

## 🎯 Objetivo
Garantir que o código siga padrões de segurança, resiliência e performance ajustados para as três infraestruturas do Marcos (ATI, AWS e Hostinger).

---

## 🌍 Consciência de Ambiente (Obrigatório)
Antes de cada tarefa, a IA deve identificar o contexto:
- **NORONHA (ATI):** Foco em Resiliência e Latência. O usuário está em conexão instável.
- **CADENCE (AWS):** Foco em Escalabilidade e Custo. É um SaaS que precisa crescer.
- **MARIBE (Hostinger):** Foco em PHP e Recursos Limitados. Estabilidade é chave.

---

## 🧠 Fluxo de Execução (PIPELINE)

1. **Brainstorming** (`brainstorming-preflight`) → Identificar o Ambiente + Criar a Solução.
2. **Planejamento** (`planning-architect`) → Definir arquivos e fluxo de dados.
3. **Execução** → Implementar usando as skills abaixo.

---

## ⚡ Fast Path (Tarefas Triviais)
Pode pular Brainstorming/Planning apenas para:
- Pequenos bug fixes, erros de digitação ou ajustes visuais mínimos.
- **PROIBIDO:** Se tocar em Autenticação, Pagamentos ou Segurança de Dados, use o fluxo completo.

---

## 🛠️ Skills de Execução
Use conforme o contexto da tarefa:
- `secure-compliance-reviewer`: Obrigatório para mudanças em dados ou backend.
- `resilience-performance-master`: Obrigatório para novas telas ou fluxos de dados.
- `component-split-enforcer`: Para manter arquivos Next.js/React < 500 linhas.
- `clean-code-editor`: Para refatoração e limpeza.

---

## 🧹 Disciplina de Saída (Regra de Ouro)
Toda entrega de código **DEVE** conter uma seção final chamada `🗣️ Explicação Simples`. 
*(Substitui a necessidade de chamar a skill plain-language-explainer separadamente)*.

**Estrutura da Saída:**
1. 💻 **Código Implementado**
2. 🛡️ **Nota de Segurança/Performance** (O que foi feito para proteger o ambiente alvo).
3. 🗣️ **Explicação Simples:** O que mudou, por que mudou e qual o benefício real para quem usa.

---

## 🏷️ Convenções
- Nomes em **Inglês**.
- Uma responsabilidade por arquivo.
- Evitar "God Files" (arquivos que fazem tudo).