# AGENTS.md

## 🎯 Objective
Ensure all code follows high standards of security, clarity, maintainability, and real-world usability, prioritizing clean architecture and user experience.

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
  - variables
  - functions
  - components
  - classes
  - files
- Use **clear and descriptive names**
  - ❌ `data`, `handleThing`
  - ✅ `userList`, `createUserHandler`

---

## 🧹 Clean Code Rules

- Avoid unnecessary comments:
  - Code should be self-explanatory
  - Comments should only exist when they add real value
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
- Handle errors without leaking internal details
- Be proactive: think about **possible vulnerabilities and abuse scenarios**

---

## 🗄️ Data & Modeling

- Use consistent naming across database and code
- Clearly define relationships and constraints
- Avoid redundant or duplicated data
- Consider scalability and future evolution
- Always think about **data integrity**

---

## 🌐 API Design

- Keep contracts consistent and predictable
- Use clear request/response structures
- Standardize error handling
- Avoid breaking changes whenever possible

---

## 🎨 UX & Product Thinking

- Always consider the **user experience**
- Reduce friction and cognitive load
- Ensure clear feedback:
  - success
  - error
  - loading states
- Avoid unnecessary steps in flows
- Prioritize usability over visual complexity

---

## 🧪 Refactoring Mindset

- Always leave the code better than you found it
- Reduce duplication
- Improve readability
- Simplify logic when possible

---

## 🧠 Explanation Rule (VERY IMPORTANT)

Whenever a change is made:

- Provide a **simple explanation in plain language**
- Explain as if speaking to:
  - a non-technical person OR
  - a child
- Focus on:
  - what changed
  - why it changed
  - what problem it solves

---

## 🚫 What to Avoid

- Overengineering
- Premature optimization
- Large unstructured files
- Mixing responsibilities
- Ignoring edge cases or error scenarios

---

## ✅ Expected Outcome

- Clean, secure, and maintainable code
- Consistent structure across the project
- Thoughtful user experience
- Clear and simple explanations of changes

---

## Preferred Skills Routing

Use these skills whenever applicable:
- `secure-backend-review` for endpoints, auth, permissions, queries, uploads, and external integrations
- `domain-data-modeler` for entities, schema design, relationships, and status modeling
- `component-split-enforcer` for large UI files, pages, and refactors involving oversized components
- `clean-code-editor` for refactors, cleanup, readability, and naming improvements
- `ux-flow-critic` for pages, forms, tables, filters, modals, dashboards, and user-facing flows
- `plain-language-explainer` after meaningful changes so the result is explained in very simple language