// ==========================================================================
// 共用的貓咪清單存取工具
// 後台「登記新貓咪 / 修改資料 / 已被收養（移除）」三個操作都透過這裡讀寫
// localStorage，讓三個功能真正對同一份清單生效，而不是各自獨立、互不影響。
// ==========================================================================
(function (global) {
     const STORAGE_KEY = "catAdoptionList";

     // 種子資料：跟目前公開首頁展示的 5 隻貓咪一致，第一次進後台時會自動存入
     const SEED_CATS = [
          { id: 1, name: "阿福 (Fuku)", img: "https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=150&h=150&fit=crop" },
          { id: 2, name: "咪咪 (Mimi)", img: "https://images.unsplash.com/photo-1533738363-b7f9aef128ce?w=150&h=150&fit=crop" },
          { id: 3, name: "歐歐 (Oreo)", img: "https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=150&h=150&fit=crop" },
          { id: 4, name: "炭炭 (Tantan)", img: "https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13?w=150&h=150&fit=crop" },
          { id: 5, name: "拿鐵 (Latte)", img: "https://images.unsplash.com/photo-1495360010541-f48722b34f7d?w=150&h=150&fit=crop" }
     ];

     // 沒有上傳照片時使用的預設頭貼（純前端展示，離線也能用）
     const PLACEHOLDER_IMG =
          "data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 150'>" +
          "<rect width='150' height='150' fill='%23eae5e0'/>" +
          "<text x='75' y='95' font-size='60' text-anchor='middle'>%F0%9F%90%BE</text></svg>";

     function loadCats() {
          try {
               const raw = localStorage.getItem(STORAGE_KEY);
               if (raw) return JSON.parse(raw);
          } catch (e) {
               console.warn("讀取貓咪清單失敗，改用預設資料重來", e);
          }
          // 第一次使用（或資料損毀）：用種子資料重建，之後的新增／修改／刪除都以此為準
          saveCats(SEED_CATS);
          return SEED_CATS.slice();
     }

     function saveCats(list) {
          localStorage.setItem(STORAGE_KEY, JSON.stringify(list));
     }

     function getCatById(id) {
          const cats = loadCats();
          return cats.find(c => String(c.id) === String(id)) || null;
     }

     function addCat(cat) {
          const cats = loadCats();
          const nextId = cats.reduce((max, c) => Math.max(max, Number(c.id) || 0), 0) + 1;
          const newCat = { id: nextId, name: cat.name, img: cat.img || PLACEHOLDER_IMG };
          cats.push(newCat);
          saveCats(cats);
          return newCat;
     }

     function updateCat(id, changes) {
          const cats = loadCats();
          const idx = cats.findIndex(c => String(c.id) === String(id));
          if (idx === -1) return null;
          cats[idx] = Object.assign({}, cats[idx], changes);
          saveCats(cats);
          return cats[idx];
     }

     function removeCat(id) {
          const cats = loadCats();
          const idx = cats.findIndex(c => String(c.id) === String(id));
          if (idx === -1) return null;
          const removed = cats.splice(idx, 1)[0];
          saveCats(cats);
          return removed;
     }

     function escapeHtml(str) {
          return String(str)
               .replace(/&/g, "&amp;")
               .replace(/</g, "&lt;")
               .replace(/>/g, "&gt;")
               .replace(/"/g, "&quot;")
               .replace(/'/g, "&#39;");
     }

     // 掛在 window 上，讓每個頁面直接引入這支檔案後用 CatStore.xxx() 呼叫
     global.CatStore = {
          PLACEHOLDER_IMG,
          loadCats,
          saveCats,
          getCatById,
          addCat,
          updateCat,
          removeCat,
          escapeHtml
     };
})(window);
