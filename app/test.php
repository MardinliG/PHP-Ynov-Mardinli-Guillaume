<?php
$name = "Sophie Martin";
$title = "UX/UI Designer & Front-End Developer";
$about = "Passionate designer and developer with 5 years of experience creating beautiful, user-centric digital experiences. Combining creativity with technical expertise to build intuitive and visually stunning interfaces.";

$experiences = [
    [
        "title" => "Senior UX/UI Designer",
        "company" => "TechVision Innovations",
        "period" => "2019 - Present",
        "description" => "Lead designer for cutting-edge mobile applications, focusing on user-centered design principles and innovative UI solutions."
    ],
    [
        "title" => "Front-End Developer",
        "company" => "WebCraft Solutions",
        "period" => "2016 - 2019",
        "description" => "Developed responsive websites and web applications, collaborating closely with design teams to ensure pixel-perfect implementations."
    ]
];

$skills = [
    ["name" => "UI Design", "level" => 95],
    ["name" => "UX Research", "level" => 90],
    ["name" => "HTML/CSS", "level" => 95],
    ["name" => "JavaScript", "level" => 85],
    ["name" => "React", "level" => 80],
    ["name" => "Adobe Creative Suite", "level" => 90],
    ["name" => "Figma", "level" => 95],
    ["name" => "Responsive Design", "level" => 95]
];

$projects = [
    ["name" => "EcoTrack App", "image" => "https://picsum.photos/id/1/300/200"],
    ["name" => "FitnessPal Website", "image" => "https://picsum.photos/id/2/300/200"],
    ["name" => "SmartHome Dashboard", "image" => "https://picsum.photos/id/3/300/200"],
    ["name" => "TravelBuddy Mobile App", "image" => "https://picsum.photos/id/4/300/200"]
];

$contact = [
    "email" => "sophie.martin@email.com",
    "phone" => "+33 6 12 34 56 78",
    "location" => "Paris, France",
    "linkedin" => "https://www.linkedin.com/in/sophiemartin",
    "dribbble" => "https://dribbble.com/sophiemartin"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?> - Interactive CV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        :root {
            --primary-color: #ff6b6b;
            --secondary-color: #4ecdc4;
            --text-color: #2d3436;
            --bg-color: #f9f9f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--primary-color);
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .title {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .about {
            max-width: 800px;
            margin: 0 auto 2rem;
            text-align: center;
        }

        .section {
            margin-bottom: 3rem;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
            text-align: center;
        }

        .experience-item {
            background-color: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .experience-item:hover {
            transform: translateY(-5px);
        }

        .experience-item h3 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .skill-item {
            background-color: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: calc(25% - 1rem);
            text-align: center;
        }

        .skill-name {
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .skill-bar {
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .skill-progress {
            height: 100%;
            background-color: var(--primary-color);
            width: 0;
            transition: width 1s ease-in-out;
        }

        .projects {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .project-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .project-item img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        .project-item:hover img {
            transform: scale(1.1);
        }

        .project-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 1rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .project-item:hover .project-overlay {
            transform: translateY(0);
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contact-item i {
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-links a {
            color: var(--primary-color);
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .skill-item {
                width: calc(50% - 1rem);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="https://picsum.photos/id/1005/200/200" alt="<?php echo $name; ?>" class="profile-img">
            <h1><?php echo $name; ?></h1>
            <div class="title"><?php echo $title; ?></div>
        </header>

        <section class="about">
            <p><?php echo $about; ?></p>
        </section>

        <section class="section">
            <h2>Experience</h2>
            <?php foreach ($experiences as $exp): ?>
                <div class="experience-item">
                    <h3><?php echo $exp['title']; ?></h3>
                    <p><strong><?php echo $exp['company']; ?></strong> | <?php echo $exp['period']; ?></p>
                    <p><?php echo $exp['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="section">
            <h2>Skills</h2>
            <div class="skills">
                <?php foreach ($skills as $skill): ?>
                    <div class="skill-item">
                        <div class="skill-name"><?php echo $skill['name']; ?></div>
                        <div class="skill-bar">
                            <div class="skill-progress" data-level="<?php echo $skill['level']; ?>"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section">
            <h2>Projects</h2>
            <div class="projects">
                <?php foreach ($projects as $project): ?>
                    <div class="project-item">
                        <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['name']; ?>">
                        <div class="project-overlay">
                            <h3><?php echo $project['name']; ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section">
            <h2>Contact</h2>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:<?php echo $contact['email']; ?>"><?php echo $contact['email']; ?></a>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <a href="tel:<?php echo $contact['phone']; ?>"><?php echo $contact['phone']; ?></a>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?php echo $contact['location']; ?></span>
                </div>
            </div>
            <div class="social-links">
                <a href="<?php echo $contact['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="<?php echo $contact['dribbble']; ?>" target="_blank"><i class="fab fa-dribbble"></i></a>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const skillBars = document.querySelectorAll('.skill-progress');
            skillBars.forEach(bar => {
                const level = bar.getAttribute('data-level');
                setTimeout(() => {
                    bar.style.width = `${level}%`;
                }, 300);
            });
        });
    </script>
</body>
</html>