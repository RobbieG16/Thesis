import pandas as pd

# Replace with your actual file path
historical_data_path = './historical_data.csv'

# Load the historical data with date parsing
try:
    historical_data = pd.read_csv(historical_data_path, parse_dates=['DATE'], dayfirst=True)
    print(historical_data.head())
except Exception as e:
    print("Error loading historical data:", e)