# Laravel–Python AI Bridge

A foundational integration project that demonstrates how a Laravel web application can communicate with a separate Python service to run specialized logic and receive structured results through a local HTTP API.

The goal is to establish a clean connection between a web application and a Python-based engine that can later be extended with advanced AI, data analysis, and machine learning capabilities.

## Why Connect Laravel and Python?

Laravel and Python serve different responsibilities in this architecture:

- **Laravel** manages the web application, user-facing pages, product CRUD, request validation, and the main connection to the database.
- **Python** runs separately as a service for logic that benefits from Python's ecosystem, such as data analysis, prediction, anomaly detection, and future machine learning models.
- **The API bridge** carries requests and responses between the two services using JSON over HTTP.

This separation allows Python capabilities to be added without rebuilding the Laravel application or moving its core business operations into another language.

> Using Python does not automatically make an AI system more accurate or intelligent. The quality of its results depends on the algorithms, models, data, evaluation, and implementation.

## Architecture

```text
User / Browser
      |
      v
Laravel Web Application
- Product CRUD
- Input validation
- Database access
- Calls the Python service
      |
      | HTTP request with JSON
      v
Python API Service (FastAPI)
- Receives structured data
- Runs the requested logic
- Returns structured results
      |
      | HTTP response with JSON
      v
Laravel processes and displays the result
```

In the local development setup, Laravel and Python run as separate processes on the same computer. They communicate over `127.0.0.1`, so a public host or domain is not required.

## Current Demonstration

This repository uses a simple Point of Sale (POS) product-management page to demonstrate the connection.

### Laravel side

- Creates, reads, updates, and deletes product records.
- Stores product data in MySQL.
- Sends the product ID, name, current stock, and minimum stock to Python.
- Receives the analysis response and displays the result on the product page.
- Keeps product CRUD available if the Python service is temporarily unavailable.

### Python side

- Exposes a health endpoint to indicate whether the service is reachable.
- Accepts product stock data through an API endpoint.
- Returns a status and recommendation for each product.
- Uses a small **rule-based demonstration**, not a trained AI or machine learning model.

## API Responsibilities

| Endpoint | Purpose |
| --- | --- |
| `GET /health` | Lets the application or developer check whether the Python service is online. |
| `POST /analyze-stocks` | Receives product stock data and returns stock-status analysis. |

The request and response use JSON. Laravel initiates the request; Python does not continuously push data to Laravel. Python waits for requests and responds when called.

## Example Data Flow

1. A user opens the product list in the Laravel application.
2. Laravel reads the products from MySQL.
3. Laravel sends the relevant stock fields to the Python API as JSON.
4. Python processes the submitted data and returns a result for each product.
5. Laravel associates the results with the products and renders them in the website.

For the current demo, Python labels a product as `Habis`, `Menipis`, or `Aman` based on the current stock and minimum-stock threshold. This demonstrates the connection and data exchange, rather than advanced AI reasoning.

## Potential Extensions

The bridge can serve as a foundation for more advanced capabilities, for example:

- Sales-demand forecasting based on historical transactions.
- Stockout risk estimation and replenishment recommendations.
- Detection of unusual stock or sales patterns.
- Data analysis using Python libraries.
- Machine learning models exposed through API endpoints.
- Additional AI tools coordinated by Laravel's application logic.

These are future directions, not features implemented by the current demonstration.

## Design Principles

- **Separation of responsibilities:** Laravel remains the web application and business-workflow layer; Python provides specialized processing.
- **Structured communication:** services exchange explicit JSON payloads and responses.
- **Local-first development:** the integration can be tested without public hosting.
- **Graceful degradation:** failure of the Python service should not unnecessarily disable unrelated Laravel functionality.
- **Controlled execution:** database writes and important business operations should remain validated and authorized by Laravel, rather than being executed blindly from AI output.

## Project Status

This is a learning-oriented proof of concept for Laravel-to-Python API connectivity. The current stock analysis uses basic rules. It is not yet a production AI platform, and it does not currently implement deep learning or a trained machine learning model.

The main objective is to provide a working architectural foundation on which more advanced Python logic can be developed and integrated deliberately.
