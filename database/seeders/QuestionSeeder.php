<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\MatchingPair;
use App\Models\TestSection;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        MatchingPair::query()->delete();
        QuestionOption::query()->delete();
        Question::query()->delete();

        $sections = TestSection::all()->keyBy('name');

        $this->seedEnglish($sections);
        $this->seedGeneralKnowledge($sections);
        $this->seedPakistanStudies($sections);
        $this->seedIslamicStudies($sections);
        $this->seedMathematics($sections);
        $this->seedComputerSkills($sections);
        $this->seedAnalyticalReasoning($sections);
    }

    private function seedEnglish($sections): void
    {
        $sectionId = $sections['English']->id ?? null;
        if (!$sectionId)
            return;

        $questions = [
            ['text' => 'Choose the word closest in meaning to "ELOQUENT":', 'difficulty' => 'medium', 'options' => ['Silent', 'Well-spoken', 'Arrogant', 'Confused'], 'correct' => 1],
            ['text' => 'Choose the word closest in meaning to "BENEVOLENT":', 'difficulty' => 'medium', 'options' => ['Cruel', 'Jealous', 'Kind-hearted', 'Angry'], 'correct' => 2],
            ['text' => 'Choose the word closest in meaning to "OBSOLETE":', 'difficulty' => 'medium', 'options' => ['Modern', 'Outdated', 'Useful', 'Common'], 'correct' => 1],
            ['text' => 'The synonym of "PAUCITY" is:', 'difficulty' => 'hard', 'options' => ['Abundance', 'Scarcity', 'Plenty', 'Surplus'], 'correct' => 1],
            ['text' => 'Choose the word closest in meaning to "VERBOSE":', 'difficulty' => 'hard', 'options' => ['Brief', 'Wordy', 'Quiet', 'Accurate'], 'correct' => 1],
            ['text' => 'Choose the word OPPOSITE in meaning to "FRUGAL":', 'difficulty' => 'medium', 'options' => ['Thrifty', 'Careful', 'Wasteful', 'Saving'], 'correct' => 2],
            ['text' => 'Choose the word OPPOSITE in meaning to "CANDID":', 'difficulty' => 'medium', 'options' => ['Frank', 'Honest', 'Blunt', 'Deceptive'], 'correct' => 3],
            ['text' => 'Choose the word OPPOSITE in meaning to "MAGNANIMOUS":', 'difficulty' => 'hard', 'options' => ['Generous', 'Noble', 'Petty', 'Forgiving'], 'correct' => 2],
            ['text' => 'Choose the grammatically correct sentence:', 'difficulty' => 'medium', 'options' => ["He don't know the answer.", 'She have completed her homework.', 'They are going to the market.', 'I has finished my meal.'], 'correct' => 2],
            ['text' => 'Identify the correct passive voice of: "The manager approved the plan."', 'difficulty' => 'medium', 'options' => ['The plan was approved by the manager.', 'The plan is approved by the manager.', 'The plan approved by the manager.', 'The manager was approved the plan.'], 'correct' => 0],
            ['text' => 'Choose the correct indirect speech of: He said, "I am tired."', 'difficulty' => 'medium', 'options' => ['He said that he is tired.', 'He said that he was tired.', 'He told that I am tired.', 'He said that I was tired.'], 'correct' => 1],
            ['text' => 'Which preposition correctly completes: "He is good ______ mathematics."', 'difficulty' => 'easy', 'options' => ['in', 'on', 'at', 'with'], 'correct' => 2],
            ['text' => 'What is the correct plural of "Criterion"?', 'difficulty' => 'medium', 'options' => ['Criterions', 'Criterias', 'Criteria', 'Criterium'], 'correct' => 2],
            ['text' => 'Choose the correct spelling:', 'difficulty' => 'easy', 'options' => ['Accomodation', 'Accommodation', 'Acommodation', 'Acomodation'], 'correct' => 1],
            ['text' => 'Identify the figure of speech in: "The world is a stage."', 'difficulty' => 'medium', 'options' => ['Simile', 'Personification', 'Metaphor', 'Hyperbole'], 'correct' => 2],
            ['text' => 'The word "GARRULOUS" means:', 'difficulty' => 'hard', 'options' => ['Quiet and reserved', 'Excessively talkative', 'Extremely angry', 'Very happy'], 'correct' => 1],
            ['text' => 'Which sentence uses the subjunctive mood correctly?', 'difficulty' => 'hard', 'options' => ['I wish I was taller.', 'I wish I were taller.', 'I wish I am taller.', 'I wish I be taller.'], 'correct' => 1],
            ['text' => 'The correct meaning of the idiom "Bite the bullet" is:', 'difficulty' => 'medium', 'options' => ['To eat something hard', 'To endure a painful situation bravely', 'To shoot someone', 'To make a quick decision'], 'correct' => 1],
            ['text' => 'Choose the word closest in meaning to "AMELIORATE":', 'difficulty' => 'hard', 'options' => ['Worsen', 'Improve', 'Ignore', 'Destroy'], 'correct' => 1],
            ['text' => 'Identify the correct sentence:', 'difficulty' => 'medium', 'options' => ['Neither Ali nor his friends was present.', 'Neither Ali nor his friends were present.', 'Neither Ali nor his friends are present.', 'Neither Ali nor his friends be present.'], 'correct' => 1],
        ];

        $this->insertMcq($sectionId, $questions);
    }

    private function seedGeneralKnowledge($sections): void
    {
        $sectionId = $sections['General Knowledge']->id ?? null;
        if (!$sectionId)
            return;

        $questions = [
            ['text' => 'The chemical symbol for Gold is:', 'difficulty' => 'easy', 'options' => ['Go', 'Gd', 'Au', 'Ag'], 'correct' => 2],
            ['text' => 'The speed of light is approximately:', 'difficulty' => 'medium', 'options' => ['3 × 10⁶ m/s', '3 × 10⁸ m/s', '3 × 10¹⁰ m/s', '3 × 10⁴ m/s'], 'correct' => 1],
            ['text' => 'The United Nations was founded in:', 'difficulty' => 'easy', 'options' => ['1939', '1945', '1947', '1948'], 'correct' => 1],
            ['text' => 'The Headquarters of the United Nations is in:', 'difficulty' => 'easy', 'options' => ['Washington D.C.', 'Geneva', 'New York', 'London'], 'correct' => 2],
            ['text' => 'Which country is the largest in the world by area?', 'difficulty' => 'easy', 'options' => ['USA', 'Canada', 'China', 'Russia'], 'correct' => 3],
            ['text' => 'Mount Everest is located in which mountain range?', 'difficulty' => 'easy', 'options' => ['Karakoram', 'Hindu Kush', 'Himalayas', 'Andes'], 'correct' => 2],
            ['text' => 'OIC stands for:', 'difficulty' => 'easy', 'options' => ['Organisation of Islamic Corporation', 'Organisation of Islamic Cooperation', 'Organisation of International Countries', 'Organisation of Industrial Commerce'], 'correct' => 1],
            ['text' => 'The Nobel Peace Prize is awarded in which city?', 'difficulty' => 'medium', 'options' => ['Stockholm', 'Geneva', 'Oslo', 'Brussels'], 'correct' => 2],
            ['text' => 'Which planet is known as the Red Planet?', 'difficulty' => 'easy', 'options' => ['Venus', 'Jupiter', 'Mars', 'Saturn'], 'correct' => 2],
            ['text' => 'The inventor of the telephone was:', 'difficulty' => 'easy', 'options' => ['Thomas Edison', 'Alexander Graham Bell', 'Nikola Tesla', 'Guglielmo Marconi'], 'correct' => 1],
            ['text' => 'Which is the largest ocean in the world?', 'difficulty' => 'easy', 'options' => ['Atlantic', 'Indian', 'Arctic', 'Pacific'], 'correct' => 3],
            ['text' => 'DNA stands for:', 'difficulty' => 'easy', 'options' => ['Deoxyribonucleic Acid', 'Diribonucleic Acid', 'Dynamic Nucleic Acid', 'Deoxyribose Nucleic Array'], 'correct' => 0],
            ['text' => 'Which gas is most abundant in the Earth\'s atmosphere?', 'difficulty' => 'medium', 'options' => ['Oxygen', 'Carbon Dioxide', 'Hydrogen', 'Nitrogen'], 'correct' => 3],
            ['text' => 'The capital of China is:', 'difficulty' => 'easy', 'options' => ['Shanghai', 'Hong Kong', 'Beijing', 'Guangzhou'], 'correct' => 2],
            ['text' => 'Which country invented paper?', 'difficulty' => 'medium', 'options' => ['Egypt', 'India', 'China', 'Greece'], 'correct' => 2],
            ['text' => 'The human body has how many bones in total?', 'difficulty' => 'medium', 'options' => ['196', '206', '216', '226'], 'correct' => 1],
            ['text' => 'Which is the smallest country in the world by area?', 'difficulty' => 'medium', 'options' => ['Monaco', 'San Marino', 'Vatican City', 'Liechtenstein'], 'correct' => 2],
            ['text' => 'The Suez Canal connects which two bodies of water?', 'difficulty' => 'medium', 'options' => ['Red Sea and Indian Ocean', 'Mediterranean Sea and Red Sea', 'Black Sea and Caspian Sea', 'Arabian Sea and Persian Gulf'], 'correct' => 1],
            ['text' => 'What is the chemical formula of water?', 'difficulty' => 'easy', 'options' => ['HO', 'H2O', 'H2O2', 'OH'], 'correct' => 1],
            ['text' => 'Which organ in the human body produces insulin?', 'difficulty' => 'medium', 'options' => ['Liver', 'Kidney', 'Pancreas', 'Stomach'], 'correct' => 2],
        ];

        $this->insertMcq($sectionId, $questions);
    }

    private function seedPakistanStudies($sections): void
    {
        $sectionId = $sections['Pakistan Studies']->id ?? null;
        if (!$sectionId)
            return;

        $questions = [
            ['text' => 'Pakistan gained independence on:', 'difficulty' => 'easy', 'options' => ['14 August 1947', '15 August 1947', '23 March 1940', '27 October 1958'], 'correct' => 0],
            ['text' => 'The Lahore Resolution was passed on:', 'difficulty' => 'medium', 'options' => ['23 March 1940', '14 August 1947', '11 August 1947', '3 June 1947'], 'correct' => 0],
            ['text' => 'Pakistan\'s first Governor General was:', 'difficulty' => 'easy', 'options' => ['Liaquat Ali Khan', 'Khawaja Nazimuddin', 'Muhammad Ali Jinnah', 'Ghulam Muhammad'], 'correct' => 2],
            ['text' => 'Pakistan became a Republic on:', 'difficulty' => 'medium', 'options' => ['14 August 1947', '23 March 1956', '27 October 1958', '1 July 1970'], 'correct' => 1],
            ['text' => 'Pakistan\'s current Constitution was adopted in:', 'difficulty' => 'medium', 'options' => ['1956', '1962', '1973', '1985'], 'correct' => 2],
            ['text' => 'The longest river in Pakistan is:', 'difficulty' => 'easy', 'options' => ['Chenab', 'Jhelum', 'Ravi', 'Indus'], 'correct' => 3],
            ['text' => 'K-2 is located in which mountain range?', 'difficulty' => 'medium', 'options' => ['Himalayas', 'Karakoram', 'Hindu Kush', 'Sulaiman'], 'correct' => 1],
            ['text' => 'Which is the largest province of Pakistan by area?', 'difficulty' => 'easy', 'options' => ['Punjab', 'Sindh', 'KPK', 'Balochistan'], 'correct' => 3],
            ['text' => 'Tarbela Dam is built on which river?', 'difficulty' => 'medium', 'options' => ['Jhelum', 'Chenab', 'Indus', 'Ravi'], 'correct' => 2],
            ['text' => 'The Simla Agreement was signed in:', 'difficulty' => 'medium', 'options' => ['1970', '1971', '1972', '1973'], 'correct' => 2],
            ['text' => 'CPEC stands for:', 'difficulty' => 'easy', 'options' => ['China-Pakistan Economic Corridor', 'Central-Pakistan Energy Council', 'China-Pakistan Energy Corridor', 'Central-Pakistan Economic Corridor'], 'correct' => 0],
            ['text' => 'Pakistan\'s nuclear tests "Chagai" were conducted in:', 'difficulty' => 'medium', 'options' => ['1995', '1996', '1998', '1999'], 'correct' => 2],
            ['text' => 'The Indus Waters Treaty was signed between India and Pakistan in:', 'difficulty' => 'medium', 'options' => ['1947', '1956', '1960', '1965'], 'correct' => 2],
            ['text' => 'Pakistan\'s national language is:', 'difficulty' => 'easy', 'options' => ['Punjabi', 'Pashto', 'Sindhi', 'Urdu'], 'correct' => 3],
            ['text' => 'Gwadar Port is located in which province?', 'difficulty' => 'easy', 'options' => ['Sindh', 'Balochistan', 'Punjab', 'KPK'], 'correct' => 1],
            ['text' => 'Pakistan\'s national sport is:', 'difficulty' => 'easy', 'options' => ['Cricket', 'Hockey', 'Football', 'Squash'], 'correct' => 1],
            ['text' => 'Which is the largest city of Pakistan by population?', 'difficulty' => 'easy', 'options' => ['Lahore', 'Islamabad', 'Karachi', 'Faisalabad'], 'correct' => 2],
            ['text' => 'The capital of Pakistan is:', 'difficulty' => 'easy', 'options' => ['Lahore', 'Karachi', 'Islamabad', 'Rawalpindi'], 'correct' => 2],
            ['text' => 'Pakistan\'s first Prime Minister was:', 'difficulty' => 'easy', 'options' => ['Muhammad Ali Jinnah', 'Khawaja Nazimuddin', 'Liaquat Ali Khan', 'Iskander Mirza'], 'correct' => 2],
            ['text' => 'The national poet of Pakistan is:', 'difficulty' => 'easy', 'options' => ['Faiz Ahmed Faiz', 'Ahmad Faraz', 'Allama Iqbal', 'Josh Malihabadi'], 'correct' => 2],
        ];

        $this->insertMcq($sectionId, $questions);
    }

    private function seedIslamicStudies($sections): void
    {
        $sectionId = $sections['Islamic Studies']->id ?? null;
        if (!$sectionId)
            return;

        $questions = [
            ['text' => 'How many Surahs are there in the Holy Quran?', 'difficulty' => 'easy', 'options' => ['110', '114', '120', '124'], 'correct' => 1],
            ['text' => 'The first revelation of the Holy Quran was revealed in:', 'difficulty' => 'easy', 'options' => ['Cave Hira', 'Cave Thaur', 'Masjid-ul-Haram', 'Masjid-e-Nabwi'], 'correct' => 0],
            ['text' => 'How many Pillars of Islam are there?', 'difficulty' => 'easy', 'options' => ['4', '5', '6', '7'], 'correct' => 1],
            ['text' => 'The last Prophet of Islam is:', 'difficulty' => 'easy', 'options' => ['Prophet Isa (A.S)', 'Prophet Musa (A.S)', 'Prophet Ibrahim (A.S)', 'Prophet Muhammad (PBUH)'], 'correct' => 3],
            ['text' => 'The Holy Quran was compiled in book form during the caliphate of:', 'difficulty' => 'medium', 'options' => ['Hazrat Abu Bakr (R.A)', 'Hazrat Umar (R.A)', 'Hazrat Uthman (R.A)', 'Hazrat Ali (R.A)'], 'correct' => 0],
            ['text' => 'Which is the longest Surah of the Holy Quran?', 'difficulty' => 'medium', 'options' => ['Surah Al-Imran', 'Surah Al-Baqarah', 'Surah An-Nisa', 'Surah Al-Maidah'], 'correct' => 1],
            ['text' => 'Hajj is performed in the Islamic month of:', 'difficulty' => 'easy', 'options' => ['Ramadan', 'Shawwal', 'Dhul Hijjah', 'Muharram'], 'correct' => 2],
            ['text' => 'The first Mosque built in Islam is:', 'difficulty' => 'medium', 'options' => ['Masjid-ul-Haram', 'Masjid-e-Nabwi', 'Masjid-e-Aqsa', 'Masjid Quba'], 'correct' => 3],
            ['text' => 'How many Prophets are mentioned by name in the Holy Quran?', 'difficulty' => 'hard', 'options' => ['20', '25', '30', '35'], 'correct' => 1],
            ['text' => 'The Battle of Badr was fought in:', 'difficulty' => 'medium', 'options' => ['1 AH', '2 AH', '3 AH', '4 AH'], 'correct' => 1],
            ['text' => 'Which Surah is known as the "Heart of the Quran"?', 'difficulty' => 'medium', 'options' => ['Surah Al-Fatiha', 'Surah Yasin', 'Surah Al-Ikhlas', 'Surah Al-Kahf'], 'correct' => 1],
            ['text' => 'The Islamic Hijri calendar begins from the year of:', 'difficulty' => 'medium', 'options' => ['Birth of the Prophet (PBUH)', 'First revelation of Quran', 'Migration (Hijrah) to Madina', 'Battle of Badr'], 'correct' => 2],
            ['text' => 'Salat (Prayer) was made obligatory during:', 'difficulty' => 'medium', 'options' => ['Hijrah', 'Isra wal Miraj', 'Battle of Badr', 'Treaty of Hudaibiyah'], 'correct' => 1],
            ['text' => 'The word "Islam" means:', 'difficulty' => 'easy', 'options' => ['Peace and submission', 'Faith and prayer', 'Charity and fasting', 'Unity and brotherhood'], 'correct' => 0],
            ['text' => 'Which is the shortest Surah in the Holy Quran?', 'difficulty' => 'medium', 'options' => ['Surah Al-Fatiha', 'Surah Al-Ikhlas', 'Surah Al-Kawthar', 'Surah Al-Asr'], 'correct' => 2],
            ['text' => 'Zakat is one of the five pillars of Islam and is obligatory on:', 'difficulty' => 'easy', 'options' => ['Every Muslim', 'Only wealthy Muslims who meet the Nisab threshold', 'Only adult males', 'Only business owners'], 'correct' => 1],
            ['text' => 'The month of fasting in Islam is:', 'difficulty' => 'easy', 'options' => ['Muharram', 'Rajab', 'Ramadan', 'Shawwal'], 'correct' => 2],
            ['text' => 'The first Caliph of Islam was:', 'difficulty' => 'easy', 'options' => ['Hazrat Umar (R.A)', 'Hazrat Uthman (R.A)', 'Hazrat Abu Bakr (R.A)', 'Hazrat Ali (R.A)'], 'correct' => 2],
            ['text' => 'How many times is Salat (prayer) obligatory per day?', 'difficulty' => 'easy', 'options' => ['3', '4', '5', '6'], 'correct' => 2],
            ['text' => 'Which city is known as the "City of the Prophet"?', 'difficulty' => 'easy', 'options' => ['Makkah', 'Madinah', 'Jerusalem', 'Taif'], 'correct' => 1],
        ];

        $this->insertMcq($sectionId, $questions);
    }

    private function seedMathematics($sections): void
    {
        $sectionId = $sections['Mathematics']->id ?? null;
        if (!$sectionId)
            return;

        $questions = [
            ['text' => 'If 15% of a number is 45, what is the number?', 'difficulty' => 'easy', 'options' => ['250', '300', '350', '275'], 'correct' => 1],
            ['text' => 'A shopkeeper bought an article for Rs. 800 and sold it for Rs. 1000. What is the profit percentage?', 'difficulty' => 'medium', 'options' => ['20%', '25%', '30%', '15%'], 'correct' => 1],
            ['text' => 'If the ratio of boys to girls is 3:2 and there are 30 students total, how many are boys?', 'difficulty' => 'easy', 'options' => ['12', '15', '18', '20'], 'correct' => 2],
            ['text' => 'What is the LCM of 12, 15, and 20?', 'difficulty' => 'medium', 'options' => ['30', '40', '60', '120'], 'correct' => 2],
            ['text' => 'A train travels 300 km in 4 hours. What is its speed in km/h?', 'difficulty' => 'easy', 'options' => ['60', '70', '75', '80'], 'correct' => 2],
            ['text' => 'The average of 5 numbers is 40. If one number is removed, the average becomes 35. What was the removed number?', 'difficulty' => 'medium', 'options' => ['55', '60', '65', '70'], 'correct' => 1],
            ['text' => 'A pipe fills a tank in 6 hours. Another pipe drains it in 12 hours. If both are open, in how many hours will the tank fill?', 'difficulty' => 'hard', 'options' => ['8', '10', '12', '14'], 'correct' => 2],
            ['text' => 'If 6 workers complete a job in 10 days, how many days will 15 workers take?', 'difficulty' => 'medium', 'options' => ['2', '3', '4', '5'], 'correct' => 2],
            ['text' => 'An article costs Rs. 500 after a 20% discount. What was its original price?', 'difficulty' => 'medium', 'options' => ['Rs. 600', 'Rs. 620', 'Rs. 625', 'Rs. 650'], 'correct' => 2],
            ['text' => 'What is the next number in the series: 2, 6, 18, 54, ___?', 'difficulty' => 'easy', 'options' => ['108', '162', '216', '270'], 'correct' => 1],
            ['text' => 'If x + y = 10 and x − y = 4, what is x?', 'difficulty' => 'medium', 'options' => ['5', '6', '7', '8'], 'correct' => 2],
            ['text' => 'A sum of Rs. 1200 is invested at 5% simple interest per annum. What is the interest after 3 years?', 'difficulty' => 'easy', 'options' => ['Rs. 150', 'Rs. 180', 'Rs. 200', 'Rs. 210'], 'correct' => 1],
            ['text' => 'If the price of an item increases by 10% and then decreases by 10%, the net change is:', 'difficulty' => 'hard', 'options' => ['No change', '1% increase', '1% decrease', '2% decrease'], 'correct' => 2],
            ['text' => 'What is the HCF of 48 and 72?', 'difficulty' => 'easy', 'options' => ['12', '16', '18', '24'], 'correct' => 3],
            ['text' => 'A man spends 75% of his income. If his income is Rs. 24,000, how much does he save?', 'difficulty' => 'easy', 'options' => ['Rs. 5,000', 'Rs. 6,000', 'Rs. 7,000', 'Rs. 8,000'], 'correct' => 1],
            ['text' => 'What is 25% of 25% of 400?', 'difficulty' => 'medium', 'options' => ['20', '25', '30', '35'], 'correct' => 1],
            ['text' => 'What value of x satisfies: 3x + 7 = 22?', 'difficulty' => 'easy', 'options' => ['3', '4', '5', '6'], 'correct' => 2],
            ['text' => 'The sum of three consecutive even numbers is 78. What is the largest number?', 'difficulty' => 'medium', 'options' => ['24', '26', '28', '30'], 'correct' => 2],
            ['text' => 'A rectangle has a length of 12 cm and width of 8 cm. What is its area?', 'difficulty' => 'easy', 'options' => ['80 cm²', '88 cm²', '96 cm²', '104 cm²'], 'correct' => 2],
            ['text' => 'What is the next number in the Fibonacci series: 1, 1, 2, 3, 5, 8, ___?', 'difficulty' => 'easy', 'options' => ['11', '12', '13', '14'], 'correct' => 2],
        ];

        $this->insertMcq($sectionId, $questions);
    }

    private function seedComputerSkills($sections): void
    {
        $sectionId = $sections['Computer Skills']->id ?? null;
        if (!$sectionId)
            return;

        $questions = [
            ['text' => 'CPU stands for:', 'difficulty' => 'easy', 'options' => ['Central Processing Unit', 'Central Program Unit', 'Computer Processing Unit', 'Core Processing Utility'], 'correct' => 0],
            ['text' => 'Which of the following is an input device?', 'difficulty' => 'easy', 'options' => ['Monitor', 'Printer', 'Keyboard', 'Speaker'], 'correct' => 2],
            ['text' => 'RAM stands for:', 'difficulty' => 'easy', 'options' => ['Read Access Memory', 'Random Access Memory', 'Read Accessible Memory', 'Random Application Memory'], 'correct' => 1],
            ['text' => 'Which file extension is associated with MS Word documents?', 'difficulty' => 'easy', 'options' => ['.xls', '.ppt', '.docx', '.pdf'], 'correct' => 2],
            ['text' => 'In MS Excel, which function is used to find the sum of a range of cells?', 'difficulty' => 'easy', 'options' => ['=TOTAL()', '=ADD()', '=SUM()', '=PLUS()'], 'correct' => 2],
            ['text' => 'What does "www" stand for in a website address?', 'difficulty' => 'easy', 'options' => ['World Wide Web', 'World Web Works', 'Wide World Web', 'World Web Wire'], 'correct' => 0],
            ['text' => 'Which shortcut key is used to copy selected text in Windows?', 'difficulty' => 'easy', 'options' => ['Ctrl + X', 'Ctrl + V', 'Ctrl + C', 'Ctrl + Z'], 'correct' => 2],
            ['text' => 'An operating system is:', 'difficulty' => 'medium', 'options' => ['A hardware component', 'System software that manages computer resources', 'An application for browsing the internet', 'A type of computer virus'], 'correct' => 1],
            ['text' => 'Which of the following is NOT an operating system?', 'difficulty' => 'medium', 'options' => ['Windows 11', 'macOS', 'Android', 'MS Excel'], 'correct' => 3],
            ['text' => 'HTTP stands for:', 'difficulty' => 'medium', 'options' => ['HyperText Transfer Protocol', 'High Transfer Text Protocol', 'HyperText Transmission Process', 'High Tech Transfer Protocol'], 'correct' => 0],
            ['text' => 'In MS PowerPoint, the keyboard shortcut to start a slideshow from the beginning is:', 'difficulty' => 'medium', 'options' => ['F1', 'F3', 'F5', 'F7'], 'correct' => 2],
            ['text' => 'Which of the following is a type of malicious software?', 'difficulty' => 'easy', 'options' => ['Antivirus', 'Firewall', 'Trojan Horse', 'VPN'], 'correct' => 2],
            ['text' => '1 Gigabyte (GB) is equal to:', 'difficulty' => 'medium', 'options' => ['1000 MB', '1024 MB', '512 MB', '2048 MB'], 'correct' => 1],
            ['text' => 'Which of the following is used to send and receive emails?', 'difficulty' => 'easy', 'options' => ['MS Word', 'MS Outlook', 'MS Excel', 'MS Access'], 'correct' => 1],
            ['text' => 'In MS Excel, which symbol is used to start a formula?', 'difficulty' => 'easy', 'options' => ['#', '@', '=', '$'], 'correct' => 2],
            ['text' => 'The shortcut key to undo the last action in Windows is:', 'difficulty' => 'easy', 'options' => ['Ctrl + Y', 'Ctrl + Z', 'Ctrl + X', 'Ctrl + A'], 'correct' => 1],
            ['text' => 'Which of the following is a search engine?', 'difficulty' => 'easy', 'options' => ['Yahoo Mail', 'Google Chrome', 'Google Search', 'Mozilla Firefox'], 'correct' => 2],
            ['text' => 'A URL stands for:', 'difficulty' => 'medium', 'options' => ['Universal Resource Locator', 'Uniform Resource Locator', 'Unique Resource Link', 'Universal Reference Link'], 'correct' => 1],
            ['text' => 'ROM stands for:', 'difficulty' => 'easy', 'options' => ['Random Only Memory', 'Read Only Memory', 'Readable Output Memory', 'Remote Output Memory'], 'correct' => 1],
            ['text' => 'Which MS Office application is best suited for creating a budget spreadsheet?', 'difficulty' => 'easy', 'options' => ['MS Word', 'MS PowerPoint', 'MS Excel', 'MS Access'], 'correct' => 2],
        ];

        $this->insertMcq($sectionId, $questions);
    }

    private function seedAnalyticalReasoning($sections): void
    {
        $sectionId = $sections['Analytical Reasoning']->id ?? null;
        if (!$sectionId)
            return;

        $questions = [
            ['text' => 'What is the next number in the series: 1, 1, 2, 3, 5, 8, ___?', 'difficulty' => 'easy', 'options' => ['11', '12', '13', '14'], 'correct' => 2],
            ['text' => 'LIBRARY is to BOOKS as MUSEUM is to:', 'difficulty' => 'easy', 'options' => ['Visitors', 'Tickets', 'Artifacts', 'Guards'], 'correct' => 2],
            ['text' => 'BIRD is to FLOCK as FISH is to:', 'difficulty' => 'easy', 'options' => ['Pond', 'Pack', 'Colony', 'School'], 'correct' => 3],
            ['text' => 'In a code language, if "MANGO" is written as "NBOHP", how is "APPLE" written?', 'difficulty' => 'medium', 'options' => ['BQQMF', 'BPPMF', 'BQQNF', 'CQQMF'], 'correct' => 0],
            ['text' => 'Which number is the odd one out: 4, 9, 16, 20, 25?', 'difficulty' => 'easy', 'options' => ['4', '9', '20', '25'], 'correct' => 2],
            ['text' => 'If A is the brother of B, B is the sister of C, and C is the son of D, how is A related to D?', 'difficulty' => 'medium', 'options' => ['Daughter', 'Son', 'Nephew', 'Grandson'], 'correct' => 1],
            ['text' => 'Find the pattern: 2, 4, 8, 16, 32, ___', 'difficulty' => 'easy', 'options' => ['48', '56', '64', '72'], 'correct' => 2],
            ['text' => 'If all Bloops are Razzles, and all Razzles are Lazzles, which statement must be true?', 'difficulty' => 'medium', 'options' => ['All Lazzles are Bloops', 'All Bloops are Lazzles', 'All Razzles are Bloops', 'No Lazzles are Bloops'], 'correct' => 1],
            ['text' => 'Identify the odd one out: Pen, Pencil, Eraser, Sharpener, Chair', 'difficulty' => 'easy', 'options' => ['Pen', 'Pencil', 'Eraser', 'Chair'], 'correct' => 3],
            ['text' => 'What comes next in the series: Z, X, V, T, ___?', 'difficulty' => 'medium', 'options' => ['Q', 'R', 'S', 'P'], 'correct' => 1],
            ['text' => 'A is taller than B. C is taller than A. D is shorter than B. Who is the tallest?', 'difficulty' => 'medium', 'options' => ['A', 'B', 'C', 'D'], 'correct' => 2],
            ['text' => 'DOCTOR is to HOSPITAL as JUDGE is to:', 'difficulty' => 'easy', 'options' => ['Law', 'Prison', 'Courtroom', 'Police station'], 'correct' => 2],
            ['text' => 'If "+" means "×", "×" means "÷", "÷" means "−", and "−" means "+", then: 8 + 4 × 2 ÷ 3 = ?', 'difficulty' => 'hard', 'options' => ['13', '14', '15', '29'], 'correct' => 3],
            ['text' => 'Pointing to a man, a woman said, "His mother is the only daughter of my mother." How is the woman related to the man?', 'difficulty' => 'hard', 'options' => ['Grandmother', 'Sister', 'Mother', 'Aunt'], 'correct' => 2],
            ['text' => 'What is the next letter in the series: A, C, F, J, ___?', 'difficulty' => 'medium', 'options' => ['M', 'N', 'O', 'P'], 'correct' => 2],
            ['text' => 'In a row of students, Amir is 10th from the left and 5th from the right. How many students are in the row?', 'difficulty' => 'medium', 'options' => ['13', '14', '15', '16'], 'correct' => 1],
            ['text' => 'CLOCK is to TIME as THERMOMETER is to:', 'difficulty' => 'easy', 'options' => ['Heat', 'Cold', 'Temperature', 'Weather'], 'correct' => 2],
            ['text' => 'Which word does NOT belong: Apple, Mango, Banana, Carrot?', 'difficulty' => 'easy', 'options' => ['Apple', 'Mango', 'Banana', 'Carrot'], 'correct' => 3],
            ['text' => 'If Monday is the 1st day of the month, what day is the 15th?', 'difficulty' => 'medium', 'options' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday'], 'correct' => 1],
            ['text' => 'A man walks 5 km north, then 3 km east, then 5 km south. How far is he from his starting point?', 'difficulty' => 'medium', 'options' => ['1 km', '2 km', '3 km', '5 km'], 'correct' => 2],
        ];

        $this->insertMcq($sectionId, $questions);
    }

    private function insertMcq($sectionId, array $questions): void
    {
        foreach ($questions as $q) {
            $question = Question::create([
                'test_section_id' => $sectionId,
                'question_type' => 'mcq',
                'question_text' => $q['text'],
                'difficulty_level' => $q['difficulty'],
                'marks' => $q['difficulty'] === 'hard' ? 2 : 1,
                'is_active' => true,
            ]);

            foreach ($q['options'] as $index => $optionText) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $optionText,
                    'is_correct' => $index === $q['correct'],
                    'display_order' => $index,
                ]);
            }
        }
    }
}