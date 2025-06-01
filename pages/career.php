<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Our Team | Career Opportunities</title>
    <style>

:root {
            --primary-color: #10069F;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-gray: #ecf0f1;
            --dark-gray: #7f8c8d;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
        }
        
        .job-container {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .job-title {
            background-color: #10069F;
            color: white;
            padding: 15px 20px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .job-title:hover {
            background-color: #9ba3a8;
        }
        
        .job-title::after {
            content: '+';
            font-size: 24px;
        }
        
        .job-title.active::after {
            content: '-';
        }
        
        .job-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background-color: #f9f9f9;
        }
        
        .job-description {
            padding: 20px;
        }
        
        .application-form {
            background-color: white;
            padding: 20px;
            border-top: 1px solid #eee;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .submit-btn {
            background-color: #10069F;
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .submit-btn:hover {
            background-color: #27ae60;
        }
        
        .required {
            color: #e74c3c;
        }

        .header {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 0;
            box-shadow: var(--shadow);
            position: relative;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 900px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .back-button {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }
        
        .back-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="header-content">
            <a href="../indexV51.php" class="back-button">
                <i class="fas fa-chevron-left"></i> Back
            </a>
            <h1>
                <img src="../assets/images_v5/ACTC LOGO -02 SMALL.png" class="logo" alt="ACTC Public Transport" style="height: 50px;">
            </h1>
            <div style="width: 80px;"></div> <!-- Spacer for balance -->
        </div>
    </header>


    <h1>Join Our Team</h1>
    
    <div class="job-container">
        <div class="job-title">Senior Software Developer</div>
        <div class="job-content">
            <div class="job-description">
                <h3>Job Description</h3>
                <p>We're looking for an experienced Senior Software Developer to join our growing team. You'll be responsible for designing, developing, and implementing software solutions that meet business requirements.</p>
                
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Design and develop high-quality software solutions</li>
                    <li>Lead code reviews and mentor junior developers</li>
                    <li>Collaborate with cross-functional teams to define, design, and ship new features</li>
                    <li>Identify and correct bottlenecks and fix bugs</li>
                    <li>Maintain code quality, organization, and automation</li>
                </ul>
                
                <h4>Requirements:</h4>
                <ul>
                    <li>5+ years of professional software development experience</li>
                    <li>Proficiency in JavaScript, Python, or Java</li>
                    <li>Experience with cloud platforms (AWS, Azure, or GCP)</li>
                    <li>Strong understanding of database technologies</li>
                    <li>Excellent problem-solving skills</li>
                </ul>
            </div>
            
            <div class="application-form">
                <h3>Apply for this Position</h3>
                <form id="senior-dev-form">
                    <div class="form-group">
                        <label for="full-name">Full Name <span class="required">*</span></label>
                        <input type="text" id="full-name" name="full-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="linkedin">LinkedIn Profile</label>
                        <input type="text" id="linkedin" name="linkedin">
                    </div>
                    
                    <div class="form-group">
                        <label for="portfolio">Portfolio Website/GitHub</label>
                        <input type="text" id="portfolio" name="portfolio">
                    </div>
                    
                    <div class="form-group">
                        <label for="experience">Years of Relevant Experience <span class="required">*</span></label>
                        <select id="experience" name="experience" required>
                            <option value="">Select</option>
                            <option value="1-3">1-3 years</option>
                            <option value="3-5">3-5 years</option>
                            <option value="5+">5+ years</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="cover-letter">Cover Letter <span class="required">*</span></label>
                        <textarea id="cover-letter" name="cover-letter" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="resume">Upload Resume/CV <span class="required">*</span></label>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="references">Professional References (optional)</label>
                        <textarea id="references" name="references"></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="job-container">
        <div class="job-title">Marketing Manager</div>
        <div class="job-content">
            <div class="job-description">
                <h3>Job Description</h3>
                <p>We're seeking a creative and strategic Marketing Manager to lead our marketing efforts and drive brand awareness and customer acquisition.</p>
                
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Develop and implement comprehensive marketing strategies</li>
                    <li>Manage all digital marketing channels (SEO, SEM, social media, email)</li>
                    <li>Analyze market trends and prepare forecasts</li>
                    <li>Oversee the marketing budget and allocate resources effectively</li>
                    <li>Collaborate with sales and product teams to align marketing strategies</li>
                </ul>
                
                <h4>Requirements:</h4>
                <ul>
                    <li>Bachelor's degree in Marketing or related field</li>
                    <li>4+ years of marketing experience</li>
                    <li>Proven experience with digital marketing tools and techniques</li>
                    <li>Excellent communication and leadership skills</li>
                    <li>Strong analytical skills and data-driven thinking</li>
                </ul>
            </div>
            
            <div class="application-form">
                <h3>Apply for this Position</h3>
                <form id="marketing-manager-form">
                    <div class="form-group">
                        <label for="mm-full-name">Full Name <span class="required">*</span></label>
                        <input type="text" id="mm-full-name" name="mm-full-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mm-email">Email Address <span class="required">*</span></label>
                        <input type="email" id="mm-email" name="mm-email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mm-phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" id="mm-phone" name="mm-phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mm-current-company">Current Company</label>
                        <input type="text" id="mm-current-company" name="mm-current-company">
                    </div>
                    
                    <div class="form-group">
                        <label for="mm-experience">Years of Marketing Experience <span class="required">*</span></label>
                        <select id="mm-experience" name="mm-experience" required>
                            <option value="">Select</option>
                            <option value="1-3">1-3 years</option>
                            <option value="3-5">3-5 years</option>
                            <option value="5+">5+ years</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="mm-salary">Salary Expectations</label>
                        <input type="text" id="mm-salary" name="mm-salary">
                    </div>
                    
                    <div class="form-group">
                        <label for="mm-cover-letter">Cover Letter <span class="required">*</span></label>
                        <textarea id="mm-cover-letter" name="mm-cover-letter" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="mm-resume">Upload Resume/CV <span class="required">*</span></label>
                        <input type="file" id="mm-resume" name="mm-resume" accept=".pdf,.doc,.docx" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mm-portfolio">Marketing Portfolio (optional)</label>
                        <input type="file" id="mm-portfolio" name="mm-portfolio">
                    </div>
                    
                    <button type="submit" class="submit-btn">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="job-container">
        <div class="job-title">Customer Support Specialist</div>
        <div class="job-content">
            <div class="job-description">
                <h3>Job Description</h3>
                <p>We're looking for a Customer Support Specialist to provide exceptional service to our customers and help resolve their issues efficiently.</p>
                
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Respond to customer inquiries via phone, email, and chat</li>
                    <li>Identify and assess customers' needs to achieve satisfaction</li>
                    <li>Provide accurate, valid, and complete information</li>
                    <li>Handle customer complaints and provide appropriate solutions</li>
                    <li>Follow up to ensure resolution and customer satisfaction</li>
                </ul>
                
                <h4>Requirements:</h4>
                <ul>
                    <li>1+ years of customer service experience</li>
                    <li>Excellent communication and problem-solving skills</li>
                    <li>Ability to multi-task and manage time effectively</li>
                    <li>Patience when handling tough cases</li>
                    <li>Familiarity with CRM systems is a plus</li>
                </ul>
            </div>
            
            <div class="application-form">
                <h3>Apply for this Position</h3>
                <form id="support-specialist-form">
                    <div class="form-group">
                        <label for="css-full-name">Full Name <span class="required">*</span></label>
                        <input type="text" id="css-full-name" name="css-full-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="css-email">Email Address <span class="required">*</span></label>
                        <input type="email" id="css-email" name="css-email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="css-phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" id="css-phone" name="css-phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="css-availability">Availability <span class="required">*</span></label>
                        <select id="css-availability" name="css-availability" required>
                            <option value="">Select</option>
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="flexible">Flexible hours</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="css-languages">Languages Spoken</label>
                        <input type="text" id="css-languages" name="css-languages">
                    </div>
                    
                    <div class="form-group">
                        <label for="css-experience">Customer Service Experience <span class="required">*</span></label>
                        <select id="css-experience" name="css-experience" required>
                            <option value="">Select</option>
                            <option value="none">No experience</option>
                            <option value="1-2">1-2 years</option>
                            <option value="3+">3+ years</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="css-why">Why are you interested in this position? <span class="required">*</span></label>
                        <textarea id="css-why" name="css-why" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="css-resume">Upload Resume/CV</label>
                        <input type="file" id="css-resume" name="css-resume" accept=".pdf,.doc,.docx">
                    </div>
                    
                    <button type="submit" class="submit-btn">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jobTitles = document.querySelectorAll('.job-title');
            
            jobTitles.forEach(title => {
                title.addEventListener('click', function() {
                    // Toggle active class on the clicked title
                    this.classList.toggle('active');
                    
                    // Get the next element (job-content)
                    const content = this.nextElementSibling;
                    
                    if (content.style.maxHeight) {
                        // If it's open, close it
                        content.style.maxHeight = null;
                    } else {
                        // If it's closed, open it
                        content.style.maxHeight = content.scrollHeight + 'px';
                    }
                });
            });
            
            // Form submission handlers (would be connected to backend in real implementation)
            document.getElementById('senior-dev-form').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Thank you for your application for Senior Software Developer! We will review your information and get back to you soon.');
                this.reset();
            });
            
            document.getElementById('marketing-manager-form').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Thank you for your application for Marketing Manager! We will review your information and get back to you soon.');
                this.reset();
            });
            
            document.getElementById('support-specialist-form').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Thank you for your application for Customer Support Specialist! We will review your information and get back to you soon.');
                this.reset();
            });
        });
    </script>
</body>
</html>
