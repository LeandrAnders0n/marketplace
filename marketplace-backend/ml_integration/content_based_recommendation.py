import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel
import sys
import json

# Load data from CSV
data = pd.read_csv('C:/Users/Leandra/Desktop/dil-foods/marketplace-backend/ml_integration/products.csv', delimiter=';', quotechar='"')

# Create TF-IDF matrix
tfidf = TfidfVectorizer(stop_words='english')
tfidf_matrix = tfidf.fit_transform(data['description'])

# Compute cosine similarity
cosine_sim = linear_kernel(tfidf_matrix, tfidf_matrix)

# Function to get recommendations based on product name
def get_recommendations(name, cosine_sim=cosine_sim):
    try:
        # Find index of the product
        idx = data.index[data['name'] == name][0]
    except IndexError:
        # Product not found
        return []

    # Get similarity scores for the product
    sim_scores = list(enumerate(cosine_sim[idx]))
    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)
    sim_scores = sim_scores[1:6]  # Get top 5 recommendations

    # Get product indices
    product_indices = [i[0] for i in sim_scores]
    
    # Return recommended product names
    return data['name'].iloc[product_indices].tolist()

if __name__ == "__main__":
    # Get the product name from command line argument
    if len(sys.argv) != 2:
        print("Usage: python script.py <product_name>")
        sys.exit(1)
        
    product_name = sys.argv[1]
    recommendations = get_recommendations(product_name)
    print(json.dumps(recommendations))
