import sys
import json
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.linear_model import LogisticRegression

# Improved training data (Example data, should be replaced with more extensive dataset)
training_data = [
    ("Smartphone with high resolution screen", "Electronics"),
    ("Comfortable sofa with soft cushions", "Furniture"),
    ("Stylish dress for summer", "Clothing"),
    ("Science fiction novel by famous author", "Books"),
    ("Children's toy car", "Toys"),
    ("Energy-efficient refrigerator", "Home Appliances"),
    ("Football for outdoor games", "Sports Equipment"),
    ("Anti-aging skincare products", "Beauty Products"),
    ("Fresh fruits and vegetables", "Groceries"),
    ("Luxury car for long drives", "Automotive")
]

def main(description):
    # Prepare training data
    texts, labels = zip(*training_data)
    
    # Vectorize the text
    vectorizer = CountVectorizer()
    X_train = vectorizer.fit_transform(texts)
    
    # Train the model
    model = LogisticRegression()
    model.fit(X_train, labels)
    
    # Transform the description
    X_description = vectorizer.transform([description])
    
    # Predict the category
    predicted_label = model.predict(X_description)[0]
    
    # Print result as JSON
    print(json.dumps(predicted_label))

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python category_prediction_model.py <description>")
        sys.exit(1)
    
    description = sys.argv[1]
    main(description)
