const burger = document.getElementById("burger");
const navbar = document.getElementById("navbar");

const toggleIfExist = (id, cls) => {
    const el = document.getElementById(id);
    if (el) el.classList.toggle(cls);
};

burger?.addEventListener("click", () => {
    toggleIfExist("navbar", "aktif");

    toggleIfExist("kata", "muncul");
    toggleIfExist("kata1", "muncul1");
    toggleIfExist("kata2", "muncul2");
    toggleIfExist("kata3", "muncul3");
    toggleIfExist("kata4", "muncul4");

    toggleIfExist("list", "lebar");
    toggleIfExist("list1", "lebar1");
    toggleIfExist("list2", "lebar2");
    toggleIfExist("list3", "lebar3");

    toggleIfExist("akun", "tepat");
    toggleIfExist("posi", "merubah");

    toggleIfExist("divv", "ko");     
    toggleIfExist("rumah", "aktif1");
    toggleIfExist("beranda", "dowo");
});