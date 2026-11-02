# R / Shiny — SMART-pred demo (third-party project)

This folder holds a **local copy of the SMART-pred demo**, an R Shiny application for classification and regression modeling, kept here for learning and reference.

**It is not my original work.** All credit goes to the original authors from the Tulane University School of Public Health and Tropical Medicine (Samuel Kakraba, Han Wenzheng, Edmund F. Agyemang, Sudesh Srivastav and Jeffery G. Shaffer). Their original README, which includes the project link, license information and contact details, is preserved as [`UPSTREAM_README.md`](UPSTREAM_README.md).

## Contents

| File | Description |
|---|---|
| `app.R` | The Shiny app: CSV upload, descriptive statistics, model training (random forest, XGBoost, GBM, glmnet, SVM and others via `caret`) and SHAP-based interpretation |
| `DARWIN_Full.csv`, `DARWIN_SHAP_APT.csv` | Example datasets (handwriting-based features) used by the demo |
| `varimp_df.csv` | Variable-importance output used by the demo |

## Run

```r
# in R / RStudio, with this folder as the working directory
shiny::runApp("app.R")
```
