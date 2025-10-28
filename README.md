# ERP Project Documentation for Mobin Host Company

## Introduction

This project is an ERP (Enterprise Resource Planning) system developed for Mobin Host Company to efficiently manage employees. The system is designed using **Domain-Driven Design (DDD)** principles, which helps in building a scalable and maintainable solution.

## Architecture Overview

### Domain Layer
In the **Domain** layer, we utilize **Entities**, **Repositories**, and **Services** to encapsulate business logic. The **Entity** represents the core data and behavior of business objects, while **Repositories** provide methods to interact with persistent storage. **Services** handle the business logic that doesn’t naturally belong to an entity or a repository.

### Application Layer
The **Application** layer is responsible for orchestrating the flow between different components. Here, we use **DTOs (Data Transfer Objects)** to structure the data for communication between layers, and **Use Cases** to define application-specific operations. The use cases are invoked based on the actions taken by the user.

### Project Lifecycle
The following steps describe the lifecycle of the project request:
1. A request is first received from the route and directed to the controller.
2. The controller checks if the authenticated user has permission to perform the requested action (using **Authorization**).
3. If authorized, the controller forwards the request to the corresponding service.
4. The service processes the request and, if necessary, sends the corresponding data (such as an ID) to the **Use Case** to run queries.
5. The **Use Case** interacts with the **Repository** to fetch or persist data via Eloquent (for save, update, or delete operations).
6. Finally, a response is generated and sent back to the user.

### Entities vs Models
In this project, **Entities** are used in the Domain layer to represent the core business logic and behavior. **Models** are used in other layers (such as the Application layer) for interacting with the database.

### Authorization
For **authorization**, we have a well-structured policy, permission, and role management system. When creating a new action, the first step is to add it to the **Policy** to ensure only authorized users can perform the action. Next, a **Permission** is created and added to the **Permissions** table, which is associated with roles to define what actions each user can perform.

## Workflow Summary
1. **Route** sends a request to the **Controller**.
2. The **Controller** checks if the **Authenticated User** has permission for the action.
3. If authorized, the request is forwarded to the **Service**.
4. The **Service** calls the **Use Case** for querying or performing actions on data.
5. **Eloquent** is used for CRUD operations to save, update, or delete data.
6. The **Response** is generated and sent back to the user.
