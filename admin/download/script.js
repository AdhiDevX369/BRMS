document.addEventListener("DOMContentLoaded", function() {
    const documents = [
        { year: 2024, name: "2024 Business Registration Circular", url: "downloads/2024-circular.pdf" },
        { year: 2023, name: "2023 Business Registration Circular", url: "downloads/2023-circular.pdf" },
        { year: 2022, name: "2022 Business Registration Circular", url: "downloads/2022-circular.pdf" },
        { year: 2021, name: "2021 Business Registration Circular", url: "downloads/2021-circular.pdf" },
        { year: 2020, name: "2020 Business Registration Circular", url: "downloads/2020-circular.pdf" },
        { year: 2019, name: "2019 Business Registration Circular", url: "downloads/2019-circular.pdf" },
        { year: 2018, name: "2018 Business Registration Circular", url: "downloads/2018-circular.pdf" },
        // Add more documents as necessary
    ];

    const documentList = document.getElementById("document-list");

    documents.forEach(doc => {
        const li = document.createElement("li");
        li.innerHTML = `<a href="${doc.url}" download>${doc.name} (${doc.year})</a>`;
        documentList.appendChild(li);
    });
});
