```markdown
# Machine Learning Models for Product Recommendation and Category Prediction

This repository contains two machine learning models: one for predicting product categories and another for recommending similar products. Both models are implemented in Python and use popular libraries such as Scikit-learn and Pandas.

## 1. Category Prediction Model

### Overview
This model predicts the category of a product based on its description using a logistic regression classifier. The model is trained on a small example dataset and uses the `CountVectorizer` for text feature extraction.

### Files
- `category_prediction_model.py`: Python script for category prediction.

### Usage

1. **Prepare the Model**: The model is trained with a small set of example data.

2. **Run the Model**:
   ```bash
   python category_prediction_model.py "<description>"
   ```
   Replace `<description>` with the product description you want to categorize. The model will print the predicted category in JSON format.

### Example
```bash
python category_prediction_model.py "Stylish dress for summer"
```
Output:
```json
"Clothing"
```

### Dependencies
- `scikit-learn`
- `json`
- `sys`

Install the required Python packages using:
```bash
pip install scikit-learn
```

## 2. Product Recommendation Model

### Overview
This model recommends products based on their descriptions using cosine similarity between TF-IDF vectors. It reads product data from a CSV file and provides recommendations based on a given product name.

### Files
- `product_recommendation_model.py`: Python script for product recommendation.
- `products.csv`: Sample CSV file containing product data. Ensure the file path is updated in the script if needed.

### Usage

1. **Load Data**: Ensure that the `products.csv` file is available at the specified path and contains product names and descriptions.

2. **Run the Model**:
   ```bash
   python product_recommendation_model.py "<product_name>"
   ```
   Replace `<product_name>` with the name of the product for which you want recommendations. The model will print the recommended products in JSON format.

### Example
```bash
python product_recommendation_model.py "Smartphone with high resolution screen"
```
Output:
```json
["Smartwatch with fitness tracking", "Tablet with high resolution screen", ...]
```

### Dependencies
- `pandas`
- `scikit-learn`
- `json`
- `sys`

Install the required Python packages using:
```bash
pip install pandas scikit-learn
```

## Notes
- Ensure that the paths to data files are correctly specified in the scripts.
- For better performance, consider training the models with a more extensive and diverse dataset.
