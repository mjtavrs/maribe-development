# AGENTS.md

## 🎯 Objective
Ensure all code follows high standards of security, clarity, maintainability, and real-world usability, prioritizing clean architecture and user experience.

---

## 🧠 Execution Pipeline (MANDATORY)

All non-trivial tasks MUST follow this flow:

1. Brainstorming → understand the problem deeply
2. Planning → define the best approach
3. Execution → implement with quality

### 🚫 Do NOT jump directly to coding

- If the task involves:
  - new features
  - architecture decisions
  - refactors
  - complex UI
  - backend logic

👉 You MUST start with `brainstorming-preflight`

---

## ⚡ Fast Path (Trivial Tasks Exception)

If the task is trivial, you MAY skip the Brainstorming and Planning phases.

### Trivial tasks include:
- small bug fixes
- typos
- minor UI tweaks
- simple refactors with no architectural impact
- renaming variables or files
- small isolated changes

### Rules for Fast Path

- The change MUST be low risk
- The change MUST NOT affect architecture
- The change MUST NOT introduce new patterns
- The change MUST be fully understood without additional context

If there is ANY doubt → fallback to Brainstorming.

### Fast Path behavior

- proceed directly to execution
- still follow all clean code, security, and explanation rules
- still use appropriate execution skills

---

## 🧠 Phase 1 — Brainstorming

Use:
- `brainstorming-preflight`

### Purpose
- clarify the real problem
- explore multiple approaches
- avoid premature decisions

### Rules
- no code allowed
- ask questions if context is missing
- generate multiple approaches
- analyze trade-offs
- recommend ONE approach

---

## 🧠 Phase 2 — Planning

Use:
- `planning-architect`

### Purpose
Transform the chosen idea into a clear implementation plan.

### Rules
- still NO code
- define:
  - architecture decisions
  - file structure
  - responsibilities per file
  - data flow
  - integration points
- align with project standards (clean architecture, small files, etc.)

---

## 🧠 Phase 3 — Execution

Only after planning is approved:

Use appropriate skills:
- `secure-backend-review`
- `domain-data-modeler`
- `component-split-enforcer`
- `clean-code-editor`
- `ux-flow-critic`

And ALWAYS:
- `plain-language-explainer` after meaningful changes

---

## 🧠 General Principles

- Always prioritize **clarity over cleverness**
- Code must be **easy to read, understand, and maintain**
- Avoid unnecessary abstractions
- Prefer **simple and explicit solutions**
- Every decision should consider **real-world usage and impact**

---

## 🧱 Code Structure & Organization

- Avoid large files:
  - Components, services, or modules should ideally stay below **500 lines**
- Break down complex logic into **smaller, reusable pieces**
- Each file should have **a single clear responsibility**
- Extract reusable logic even if reuse is only **potential for now**
- Avoid monolithic components or "God files"

---

## 🏷️ Naming Conventions

- All code elements MUST be named in **English**
- Use **clear and descriptive names**

---

## 🧹 Clean Code Rules

- Avoid unnecessary comments
- Remove:
  - commented-out code
  - debug logs
  - unused variables
- Keep functions small and focused
- Avoid deep nesting and complex conditionals

---

## 🔐 Security (MANDATORY)

- Never trust client-side data
- Always validate and sanitize inputs
- Always enforce proper authorization checks
- Avoid exposing sensitive data unnecessarily
- Handle errors safely

---

## 🗄️ Data & Modeling

- Use consistent naming across database and code
- Clearly define relationships and constraints
- Avoid redundant data
- Ensure data integrity

---

## 🌐 API Design

- Keep contracts consistent
- Standardize error handling
- Avoid breaking changes

---

## 🎨 UX & Product Thinking

- Always consider user experience
- Reduce friction and cognitive load
- Ensure feedback states exist
- Prioritize usability over complexity

---

## 🧪 Refactoring Mindset

- Leave code better than you found it
- Reduce duplication
- Simplify logic

---

## 🧠 Explanation Rule (VERY IMPORTANT)

After any meaningful change:

Use:
- `plain-language-explainer`

---

## 🚫 What to Avoid

- Overengineering
- Premature optimization
- Skipping brainstorming or planning phases (when required)
- Large unstructured files
- Mixing responsibilities

---

## ✅ Expected Outcome

- Clean, secure, maintainable code
- Strong architectural decisions
- Thoughtful UX
- Clear explanations

---

## 🔀 Skills Routing

### Mandatory flow control
- `brainstorming-preflight` → ALWAYS before creative work (unless Fast Path applies)
- `planning-architect` → ALWAYS before implementation (unless Fast Path applies)

### Execution skills
- `secure-backend-review`
- `domain-data-modeler`
- `component-split-enforcer`
- `clean-code-editor`
- `ux-flow-critic`

### Final step
- `plain-language-explainer`