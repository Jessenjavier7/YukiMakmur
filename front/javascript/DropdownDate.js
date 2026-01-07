function fillDateDropdown(dayId, monthId, yearId) {
  const daySelect = document.getElementById(dayId);
  const monthSelect = document.getElementById(monthId);
  const yearSelect = document.getElementById(yearId);

  // === TANGGAL 1 - 31 ===
  for (let d = 1; d <= 31; d++) {
    const option = document.createElement("option");
    option.value = d;
    option.text = d;
    daySelect.appendChild(option);
  }

  // === BULAN ===
  const monthMapping = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
  ];

  monthMapping.forEach((monthName, index) => {
    const option = document.createElement("option");
    option.value = index + 1; // bulan = 1-12
    option.text = monthName;
    monthSelect.appendChild(option);
  });

  // === TAHUN (2010 – Tahun Sekarang) ===
  const currentYear = new Date().getFullYear();
  for (let y = currentYear; y >= 2010; y--) {
    const option = document.createElement("option");
    option.value = y;
    option.text = y;
    yearSelect.appendChild(option);
  }
}

fillDateDropdown("tglAwal", "blnAwal", "thnAwal");

fillDateDropdown("tglAkhir", "blnAkhir", "thnAkhir");
