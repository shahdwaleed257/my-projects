# AI Projects

Machine learning, deep learning, computer vision, NLP and information-retrieval notebooks.
They were written in Google Colab / Kaggle notebooks, so datasets are downloaded inside the notebooks and are **not** stored in this repository.

## Machine learning & big data

| Notebook | What it does | Tools | Result |
|---|---|---|---|
| `Copy_of_Mental_Health_PySpark_Updated (2).ipynb` | Predicts whether a person seeks mental-health treatment from a 292,364-row survey dataset: SQL analysis, feature encoding, risk score, three models compared | PySpark | Gradient Boosting best: ROC-AUC 0.88, accuracy 80.1%, F1 0.80 (Logistic Regression: AUC 0.80, Random Forest: AUC 0.83) |
| `Mastering_Machine_Learning_with_PySpark_Loan_Prediction.ipynb` | Loan-approval prediction with the PySpark ML pipeline | PySpark | ROC-AUC improved from 0.78 to 0.83 between the two models compared |
| `Loan_Prediction_Analysis_Classification_(1).ipynb` | Loan-approval classification on the Dream Housing Finance dataset: EDA, preprocessing, several classifiers | scikit-learn, seaborn | Accuracy 72.7%–78.6% depending on the model |
| `kmeans.ipynb` | K-Means clustering of age vs. income with scaling | scikit-learn | — |
| `stroke_prediction.ipynb` | Exploratory classification experiments on a stroke dataset | scikit-learn, Plotly | Exploratory |

## Deep learning & computer vision

| Notebook | What it does | Tools | Result |
|---|---|---|---|
| `update_chest.ipynb` | Pneumonia detection from chest X-rays with DenseNet121 transfer learning | TensorFlow/Keras | 89.1% test accuracy |
| `Another_copy_of_DenseNet_ (1).ipynb` | Earlier version of the same experiment with improved preprocessing and data augmentation | TensorFlow/Keras | — |
| `chest-x-rays-densenet121-transfer-learning.ipynb` | Reference DenseNet121 pneumonia pipeline with callbacks and a full classification report | TensorFlow/Keras | ≈95% accuracy on the 624-image test set (pneumonia recall 0.98) |
| `Handwritten_digits_classification_using_neural_network.ipynb` | Handwritten-digit classifier with a dense neural network | TensorFlow/Keras | ≈91.6% test accuracy after 5 epochs |
| `deep_learning_model.ipynb`, `dr_osama.ipynb` | Facial-expression recognition experiments on the FER2013 dataset (`dr_osama` also explores face detection with facenet-pytorch / Ultralytics) | TensorFlow/Keras, PyTorch, OpenCV | Experiments |
| `ANOMLY_DETECTION.ipynb` | Autoencoder-based anomaly detection on MNIST | PyTorch | ROC-AUC ≈ 0.90 |
| `Copy_of_anomly_detection.ipynb` | Autoencoder anomaly detection on Fashion-MNIST with interactive widgets | PyTorch, OpenCV | Experiment |
| `anomaly_carpetdata.ipynb` | Autoencoder anomaly detection on the MVTec AD "carpet" category | PyTorch | Exploratory baseline |
| `Final_Computer_Vision_Project_(1).ipynb` | Desktop GUI for image processing | Tkinter, OpenCV, Pillow | — |

## NLP & information retrieval

| Notebook | What it does | Tools |
|---|---|---|
| `IR_Project.ipynb` | Information-retrieval system with AND / OR / phrase queries and TF-IDF ranking | NLTK |
| `IR_simple_search_engine.ipynb` | Search-engine basics: tokenization, stop-word removal, lemmatization and a positional index | NLTK |
| `SMS_Spam_Classification.ipynb` | Reproduces a paper's SMS spam classification with a pre-trained BART model and compares to the paper's reported numbers. Reference paper: `pdf-researsh.pdf` ("Adaptable and Reliable Text Classification using Large Language Models", arXiv:2405.10523). **Team project (6 students).** | Hugging Face Transformers, scikit-learn |

## Data analysis & dashboards

| Notebook | What it does | Tools |
|---|---|---|
| `employeedatavisulization.ipynb` | Data cleaning and visualization of an employee-attrition dataset | pandas, seaborn |
| `Dashboard_for_employee.ipynb` | Interactive attrition dashboard | Dash, Plotly, Bootstrap |

## Running the notebooks

Open a notebook in Google Colab, or locally with Jupyter. Notebooks that download Kaggle data need **your own** Kaggle API token (`kaggle.json`); never commit it.
