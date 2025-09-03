import "./bootstrap";
import Alpine from "alpinejs";
import Swal from "sweetalert2";
import DataTable from "datatables.net";
import "datatables.net-dt/css/dataTables.dataTables.css";

window.Alpine = Alpine;
window.Swal = Swal;
window.DataTable = DataTable;

Alpine.start();

// Search (CTRL+K)
document.addEventListener("keydown", function (e) {
    if ((e.ctrlKey || e.metaKey) && e.key === "k") {
        e.preventDefault();
        const searchInput = document.getElementById("searchInput");
        if (searchInput) {
            searchInput.focus();
        }
    }
});
