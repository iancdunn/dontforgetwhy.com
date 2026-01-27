# dontforgetwhy (DFY) - Intentional Financial Engine

A LAMP-stack personal finance application designed to enforce intentional capital allocation. Unlike standard expense trackers, this tool uses a **Zero-Based Budgeting** algorithm to automatically split every deposit into four strategic buckets: *Needs*, *Wants*, *Savings*, and *Investments*.

The project emphasizes backend logic integrity, handling floating-point arithmetic precision and strict session-based security for financial data.

## Key Features

* **Automated Allocation:** Deposits are programmatically split into four categories based on user-defined percentages.
* **Granular Asset Tracking:** Distinct separation between "Savings" (Safe/Liquid) and "Investments" (Volatile/Growth) to encourage the "Golden Era of Compounding" mindset.
* **Transactional Integrity:** Logic gates prevent withdrawals if a specific bucket (e.g., "Wants") lacks sufficient funds, even if the Total Balance is positive.
* **Math Precision:** Implements a custom algorithm in `transaction_backend.php` to correct floating-point rounding errors that occur when splitting currency across multiple percentages.
* **Secure Authentication:** Utilizes PHP sessions and `password_hash()`/`password_verify()` for secure user access.

## Responsive Design

The application implements a fully responsive user interface optimized for cross-device compatibility.

* **Adaptive Navigation:** Utilizes **CSS Media Queries** (`@media`) to dynamically transform the navigation bar from a horizontal desktop layout to a vertical, touch-friendly stack on mobile devices (<768px).
* **Fluid Layouts:** Implements **Flexbox** and fluid percentages to ensure forms and data tables scale perfectly from large monitors down to smartphone screens without horizontal scrolling.
* **Viewport Optimization:** Configured with proper viewport meta tags to ensure accurate scaling and readability on high-density (Retina) mobile displays.

## Tech Stack

* **Backend:** PHP 8.x
* **Database:** MySQL (Relational Schema)
* **Frontend:** HTML5, CSS3
* **Environment:** XAMPP / LAMP Stack

## Project Structure

```text
dontforgetwhy/
├── db.php                     # Database connection configuration
├── transaction_backend.php    # Core ETL logic for deposits/withdrawals
├── allocation_backend.php     # Logic for updating budget percentages
├── login_backend.php          # Authentication handling
├── home.php                   # User Dashboard
├── transaction.php            # Transaction Input Form
└── style.css                  # Custom styling
