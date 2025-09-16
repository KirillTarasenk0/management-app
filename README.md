I’d like to share a bit about one of our internal projects built on the Symfony framework.

The application is developed using hexagonal architecture with a clear separation of concerns and follows CQRS principles for command and query handling. This structure gives us a clean domain layer and makes it easy to evolve or replace infrastructure components when needed.

While the production repository itself is private and we can’t provide direct access, I can give you a quick overview of the stack. Here’s an excerpt from our composer.json so you can see the core dependencies:

- Symfony 6.3 (framework-bundle, security-bundle, messenger, serializer, etc.)

- Doctrine ORM & Migrations for persistence

- Google API Client, Nelmio CORS Bundle, and other supporting packages

- PHP 8.2 and strict typing across the codebase

Kirill, one of our team members, also spends his free time writing internal utilities and tooling around this project to keep development smooth and automated.