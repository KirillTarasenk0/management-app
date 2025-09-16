I’d love to share a bit about a personal side project I’ve been building with the Symfony framework.

The application is structured around a hexagonal architecture and applies CQRS principles, which keeps the domain logic clean and independent from the infrastructure layer. This design makes it easy to experiment, refactor, and evolve the codebase over time.

Here’s a snapshot of the main stack:

- Symfony 6.3 (framework-bundle, security-bundle, messenger, serializer, etc.)

- Doctrine ORM & Migrations for data persistence

- Google API Client, Nelmio CORS Bundle, and several supporting libraries

- PHP 8.2 with strict typing across the project

It’s not something I maintain as a public service, but it’s a project I continue to refine in my spare time—adding new features, exploring different patterns, and using it as a playground for testing ideas and improving my skills.

Best regards,
Kirill