<?php
namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $categories = [
            'Electronics', 'Furniture', 'Clothing', 'Books', 'Toys',
            'Home Appliances', 'Sports Equipment', 'Beauty Products', 'Groceries', 'Automotive'
        ];

        $names = [
            'Electronics' => ['Smartphone', 'Laptop', 'Smartwatch', 'Tablet', 'Headphones', 'Camera', 'Speaker', 'Monitor', 'Mouse', 'Keyboard'],
            'Furniture' => ['Sofa', 'Dining Table', 'Chair', 'Bed', 'Wardrobe', 'Bookshelf', 'Coffee Table', 'Desk', 'Nightstand', 'Dresser'],
            'Clothing' => ['T-shirt', 'Jeans', 'Dress', 'Jacket', 'Sweater', 'Skirt', 'Blouse', 'Shorts', 'Suit', 'Tracksuit'],
            'Books' => ['Novel', 'Biography', 'Science Fiction', 'Fantasy', 'Non-fiction', 'Mystery', 'Thriller', 'Historical', 'Romance', 'Poetry'],
            'Toys' => ['Action Figure', 'Doll', 'Puzzle', 'Board Game', 'Toy Car', 'Building Blocks', 'Stuffed Animal', 'Educational Toy', 'Toy Robot', 'Toy Train'],
            'Home Appliances' => ['Refrigerator', 'Microwave', 'Washing Machine', 'Dishwasher', 'Oven', 'Vacuum Cleaner', 'Air Conditioner', 'Heater', 'Toaster', 'Blender'],
            'Sports Equipment' => ['Football', 'Basketball', 'Tennis Racket', 'Cricket Bat', 'Golf Club', 'Badminton Racket', 'Baseball Glove', 'Boxing Gloves', 'Skateboard', 'Bicycle'],
            'Beauty Products' => ['Lipstick', 'Foundation', 'Mascara', 'Blush', 'Eyeliner', 'Perfume', 'Moisturizer', 'Shampoo', 'Conditioner', 'Nail Polish'],
            'Groceries' => ['Apple', 'Banana', 'Orange', 'Milk', 'Bread', 'Eggs', 'Cheese', 'Chicken', 'Beef', 'Rice'],
            'Automotive' => ['Tire', 'Engine Oil', 'Brake Pad', 'Battery', 'Headlight', 'Wiper Blade', 'Spark Plug', 'Car Cover', 'GPS Navigator', 'Car Vacuum Cleaner']
        ];

        $category = $this->faker->randomElement($categories);
        $name = $this->faker->randomElement($names[$category]);
        $description = "A high-quality $name from our $category category.";
        $price = $this->faker->randomFloat(2, 10, 1000);
        $stock = $this->faker->numberBetween(10, 100);

        return [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'category' => $category
        ];
    }
}
