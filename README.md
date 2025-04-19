# ⚽ FutRank – Oceny zawodników piłkarskich

**FutRank** to internetowa aplikacja stworzona w Laravelu, pozwalająca użytkownikom oceniać zawodników piłkarskich, przeglądać komentarze i wiele więcej – wszystko w przyjaznym i nowoczesnym interfejsie.

---

## 🚀 Funkcje

- ✅ Rejestracja i logowanie (z uwierzytelnieniem, resetowaniem i weryfikacją e-mail)
- 🧑 Lista zawodników z możliwością:
  - oceniania (1–5 gwiazdek)
  - komentowania
  - filtrowania po klubie, pozycji, miejscu urodzenia, nazwie i komentarzach
  - sortowania po nazwie i ocenie
- 🔍 Wyszukiwanie w komentarzach i po nazwie zawodnika
- 🧠 Analiza komentarzy z wykorzystaniem AI (Hugging Face / Sentiment Analysis)
- 🏆 Ranking zawodników na podstawie średnich ocen
- 📊 Dashboard użytkownika
- 🧾 Edytowanie / usuwanie własnych ocen
- 🔐 Potwierdzenia przed usunięciem danych (np. zawodnika, konta)
- 🌍 Możliwość przeglądania listy bez logowania
- 🔧 Panel użytkownika (edycja profilu, zmiana hasła, usunięcie konta)

---

## 🧑‍💻 Technologie

- **Backend:** Laravel 10 / 12 (MVC + Eloquent ORM)
- **Frontend:** Blade + Tailwind CSS + Alpine.js
- **AI:** Hugging Face API (`cardiffnlp/twitter-xlm-roberta-base-sentiment`)
- **Autoryzacja:** Laravel Breeze (z middleware do weryfikacji)
- **Baza danych:** MySQL
---