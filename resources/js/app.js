import './bootstrap';
//--------
import Headroom from "headroom.js";

document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector("header");
    const topbar = document.getElementById("topbar");

    const headroom = new Headroom(topbar, {
        offset: 80,
        tolerance: 5,
        classes: {
            initial: "headroom",
            pinned: "headroom--pinned",
            unpinned: "headroom--unpinned",
        },
    });

    headroom.init();
});
