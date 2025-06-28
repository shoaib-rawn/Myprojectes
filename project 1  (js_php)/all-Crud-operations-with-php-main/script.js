let selectedId = null;
//alert("Submit button clicked!");

function onFormSubmit(event) {
    event.preventDefault();
    const formData = readFormData();

    if (selectedId == null) {
        // Create new record
        fetch('create.php', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData)
        }).then(() => {
            resetForm();
            loadData();
        });
    } else {
        // Update record
        formData.id = selectedId;
        console.log("Updating ID:", formData);
        fetch('update.php', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData)
        }).then(() => {
            selectedId = null;
            resetForm();
            loadData();
        });
    }
}

function readFormData() {
    return {
        productCode: document.getElementById("productCode").value,
        product: document.getElementById("product").value,
        qty: document.getElementById("qty").value,
        perPrice: document.getElementById("perPrice").value
    };
}

function resetForm() {
    document.getElementById("productCode").value = "";
    document.getElementById("product").value = "";
    document.getElementById("qty").value = "";
    document.getElementById("perPrice").value = "";
    selectedId = null;
}

function loadData() {
    fetch('read.php')
        .then(res => res.json())
        .then(data => {
            const table = document.getElementById("storeList").getElementsByTagName('tbody')[0];
            table.innerHTML = "";

            data.forEach(item => {
                let row = table.insertRow();
                row.insertCell(0).innerHTML = item.productCode;
                row.insertCell(1).innerHTML = item.product;
                row.insertCell(2).innerHTML = item.qty;
                row.insertCell(3).innerHTML = item.perPrice;
                row.insertCell(4).innerHTML = `
                    <button onclick='onEdit(${JSON.stringify(item)})'>Edit</button>
                    <button onclick='onDelete(${item.id})'>Delete</button>`;
            });
        });
}

function onEdit(item) {
    selectedId = item.id;
    document.getElementById("productCode").value = item.productCode;
    document.getElementById("product").value = item.product;
    document.getElementById("qty").value = item.qty;
    document.getElementById("perPrice").value = item.perPrice;
}

function onDelete(id) {
    if (confirm('Do you want to delete this record?')) {
        fetch('delete.php', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: id })
        }).then(() => {
            loadData();
        });
    }
}

// Auto-load data when page opens
window.onload = loadData;
