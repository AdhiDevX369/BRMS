document.getElementById('dateForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const { jsPDF } = window.jspdf;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    const doc = new jsPDF();

    doc.setFontSize(20);
    doc.text("Date Range PDF", 20, 20);
    doc.setFontSize(16);
    doc.text(`Start Date: ${startDate}`, 20, 40);
    doc.text(`End Date: ${endDate}`, 20, 50);

    // Save the PDF
    doc.save(`DateRange_${startDate}_to_${endDate}.pdf`);
});
