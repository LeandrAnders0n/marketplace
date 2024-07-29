```markdown
# Full-Stack Developer Assignment

This project consists of three main parts: frontend development with Vue.js, backend development with Laravel PHP, and machine learning integration for product recommendation and category prediction.

# Screenshots
## Login
(assets/Login.png)
## Register
(assets/Register.png)
## Home
(assets/Home.png)
## Search
(assets/Search.png)
## Wishlist
(assets/Wishlist.png)
## Cart
(assets/Cart.png)
## Product Suggestions
(assets/Recommended.png)
## Responsive Design
### Phone(Pixel)
(assets/Phone.png)
### Tab(Ipad Air)
(assets/Ipad.png)

## Part 1: Frontend Development (Vue.js)

### Task
Create a web application for a product marketplace.

### Requirements
- Use Vue.js for the frontend.
- Implement a search bar with real-time filtering of products.
- Add user authentication (login/register) using JWT tokens.
- Allow authenticated users to add products to their wishlist.
- Implement shopping cart functionality with the ability to add/remove products.
- Use a design system or UI component library (e.g., Vuetify for Vue.js).
- Ensure the application is fully responsive and adheres to modern UX/UI standards.

## Part 2: Backend Development (Laravel PHP)

### Task
Develop a comprehensive API to manage the marketplace functionalities.

### Requirements
- Use Laravel to build the backend API.
- Implement user authentication with JWT tokens.
- Provide endpoints for product management using JSON for data storage (CRUD operations).
- Implement wishlist functionality for authenticated users.
- Create endpoints for managing the shopping cart (add/remove products, checkout).
- Implement authentication and authorization.
- Use MySQL for DB storage and retrieval.

## Part 3: Machine Learning Integration

### Task
Integrate an advanced ML model for product recommendation and category prediction.

### Requirements
- Train or use a pre-trained ML model to recommend products based on user behavior (collaborative filtering or content-based filtering).
- Train or use a pre-trained ML model to predict the category of a product based on its description.
- Create endpoints in Laravel to handle product recommendations and category predictions.
- Ensure scalability and performance of the ML integration.

## ML Model for Product Recommendation

1. **Model Training**:
   - Use a pre-trained model or train a model using collaborative filtering or content-based filtering techniques.
   - Train the model using historical user behavior data.

2. **Model Deployment**:
   - Save the trained model and integrate it into the Laravel backend.
   - Create an endpoint in Laravel to serve product recommendations based on user data.

3. **Category Prediction**:
   - Use or train a model to predict product categories based on descriptions.
   - Integrate the model into the Laravel backend and create an endpoint for category predictions.

## Setup and Running the Application

### Prerequisites
- Node.js
- NPM/Yarn
- PHP
- Composer
- MySQL
- Python (for ML models)

### Frontend Setup

1. **Navigate to the frontend directory**:
   ```bash
   cd frontend
   ```

2. **Install dependencies**:
   ```bash
   npm install
   # or
   yarn install
   ```

3. **Run the frontend application**:
   ```bash
   npm run serve
   # or
   yarn serve
   ```

### Backend Setup

1. **Navigate to the backend directory**:
   ```bash
   cd backend
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Configure the environment**:
   - Copy `.env.example` to `.env` and configure your database and other settings.

4. **Run migrations and seed the database**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Run the backend application**:
   ```bash
   php artisan serve
   ```

### Machine Learning Setup

1. **Install Python dependencies**:
   ```bash
   pip install -r requirements.txt
   ```

2. **Train or load the ML models**:
   - Follow the specific instructions provided with the model to train or load it.

3. **Integrate ML models with the Laravel backend**:
   - Ensure the model is accessible via API endpoints.

## Notes

- Ensure that both frontend and backend applications are running simultaneously for full functionality.
- Test the application thoroughly to ensure all parts are working as expected.
