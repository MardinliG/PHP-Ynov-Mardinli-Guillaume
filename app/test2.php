<?php
$company_name = "TechVision";
$tagline = "Innovate. Create. Elevate.";
$description = "We're revolutionizing the digital landscape with cutting-edge solutions that empower businesses to thrive in the modern world.";

$features = [
    [
        "icon" => "fas fa-rocket",
        "title" => "Lightning Fast",
        "description" => "Our solutions are optimized for speed, ensuring your business never slows down."
    ],
    [
        "icon" => "fas fa-shield-alt",
        "title" => "Secure by Design",
        "description" => "Built-in security features protect your data and give you peace of mind."
    ],
    [
        "icon" => "fas fa-sync",
        "title" => "Always Evolving",
        "description" => "We continuously update our products to stay ahead of the curve."
    ]
];

$cta_text = "Ready to transform your business?";
$cta_button = "Get Started";

$login_text = "Already a customer?";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $company_name; ?> - Innovative Digital Solutions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        :root {
            --primary-color: #4ecdc4;
            --secondary-color: #ff6b6b;
            --text-color: #2d3436;
            --bg-color: #f9f9f9;
            --white: #ffffff;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .login-btn {
            background-color: var(--secondary-color);
            color: var(--white);
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #ff8585;
        }

        .hero {
            text-align: center;
            padding: 4rem 0;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .tagline {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 2rem;
        }

        .description {
            max-width: 800px;
            margin: 0 auto 3rem;
        }

        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .feature {
            flex-basis: calc(33.333% - 2rem);
            background-color: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-5px);
        }

        .feature i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature h3 {
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }

        .cta {
            text-align: center;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 4rem 0;
            border-radius: 10px;
        }

        .cta h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .cta-btn {
            background-color: var(--secondary-color);
            color: var(--white);
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #ff8585;
        }

        @media (max-width: 768px) {
            .feature {
                flex-basis: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><?php echo $company_name; ?></div>
            <button class="login-btn">Login</button>
        </header>

        <section class="hero">
            <h1><?php echo $company_name; ?></h1>
            <div class="tagline"><?php echo $tagline; ?></div>
            <p class="description"><?php echo $description; ?></p>
        </section>

        <section class="features">
            <?php foreach ($features as $feature): ?>
                <div class="feature">
                    <i class="<?php echo $feature['icon']; ?>"></i>
                    <h3><?php echo $feature['title']; ?></h3>
                    <p><?php echo $feature['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="cta">
            <h2><?php echo $cta_text; ?></h2>
            <button class="cta-btn"><?php echo $cta_button; ?></button>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginBtn = document.querySelector('.login-btn');
            loginBtn.addEventListener('click', () => {
                alert('Login functionality would be implemented here.');
            });

            const ctaBtn = document.querySelector('.cta-btn');
            ctaBtn.addEventListener('click', () => {
                alert('Get Started process would be implemented here.');
            });
        });
    </script>
</body>
</html>