from fastapi import FastAPI
from pydantic import BaseModel, Field

app = FastAPI(
    title="POS Python Engine",
    description="Layanan lokal untuk menunjukkan komunikasi Laravel ke Python.",
    version="1.0.0",
)


class ProductStock(BaseModel):
    id: int
    name: str = Field(min_length=1, max_length=255)
    stock: int = Field(ge=0)
    minimum_stock: int = Field(ge=0)


class StockAnalysisRequest(BaseModel):
    products: list[ProductStock]


@app.get("/health")
def health() -> dict:
    return {
        "status": "online",
        "service": "POS Python Engine",
        "purpose": "local Laravel-Python integration demo",
    }


@app.post("/analyze-stocks")
def analyze_stocks(payload: StockAnalysisRequest) -> dict:
    results = []

    for product in payload.products:
        if product.stock == 0:
            status = "Habis"
            recommendation = "Stok kosong. Periksa kebutuhan pengadaan."
        elif product.stock <= product.minimum_stock:
            status = "Menipis"
            recommendation = (
                f"Stok {product.stock} sudah mencapai atau di bawah "
                f"batas minimum {product.minimum_stock}. Pertimbangkan restock."
            )
        else:
            status = "Aman"
            recommendation = "Stok berada di atas batas minimum."

        results.append(
            {
                "product_id": product.id,
                "status": status,
                "recommendation": recommendation,
            }
        )

    return {
        "engine": "python-rule-based-demo",
        "count": len(results),
        "results": results,
    }
