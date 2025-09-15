# Security Policy

## 🔒 Reporting Security Vulnerabilities

We take security seriously. If you discover a security vulnerability in Laravel Persian Validation, please report it responsibly.

### 📧 How to Report

**DO NOT** open a public GitHub issue for security vulnerabilities.

Instead, please send an email to:
- **Email**: farhad.pd@gmail.com
- **Subject**: [SECURITY] Laravel Persian Validation - [Brief Description]

### 📋 What to Include

Please include the following information in your report:

1. **Description** of the vulnerability
2. **Steps to reproduce** the issue
3. **Potential impact** of the vulnerability
4. **Suggested fix** (if you have one)
5. **Your contact information** for follow-up

### 🕐 Response Timeline

- **Acknowledgment**: Within 48 hours
- **Initial Assessment**: Within 1 week
- **Status Update**: Every week until resolved
- **Resolution**: Depends on severity and complexity

### 🏆 Recognition

Security researchers who responsibly report vulnerabilities will be:
- Credited in the security advisory (unless they prefer to remain anonymous)
- Mentioned in our Hall of Fame (if applicable)
- Thanked publicly after the issue is resolved

## 🛡️ Security Best Practices

### For Users

1. **Keep Updated**: Always use the latest version of the package
2. **Review Dependencies**: Regularly audit your composer dependencies
3. **Input Validation**: Use this package for validation, but also implement proper input sanitization
4. **Error Handling**: Don't expose sensitive validation logic in error messages

### For Contributors

1. **Secure Coding**: Follow OWASP secure coding guidelines
2. **Input Validation**: Validate all inputs thoroughly
3. **Dependencies**: Keep dependencies updated and secure
4. **Testing**: Include security test cases

## 🔍 Vulnerability Types

We're particularly interested in reports about:

- **Input Validation Bypass**: Ways to bypass validation rules
- **Regular Expression DoS**: ReDoS vulnerabilities in regex patterns
- **Information Disclosure**: Leaking sensitive information through error messages
- **Dependency Vulnerabilities**: Issues in third-party dependencies

## 📜 Supported Versions

| Version | Supported          |
| ------- | ------------------ |
| 3.3.x   | ✅ Yes            |
| 3.2.x   | ✅ Yes            |
| 3.1.x   | ⚠️ Critical fixes only |
| < 3.1   | ❌ No             |

## 🔄 Security Updates

Security updates will be released as patch versions (e.g., 3.3.1) and will be:
- Documented in [CHANGELOG.md](CHANGELOG.md)
- Announced in GitHub releases
- Published to Packagist immediately

## 📚 Security Resources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security Best Practices](https://laravel.com/docs/security)
- [Composer Security](https://getcomposer.org/doc/articles/security.md)

## 🤝 Security Partnership

If you're a security company or researcher interested in a more formal security partnership, please contact us at farhad.pd@gmail.com.

---

Thank you for helping keep Laravel Persian Validation secure! 🛡️
