# DNS Setup Guide for www.fidget-widgets.com

## Your Domain: www.fidget-widgets.com

This guide will help you point your domain to GitHub Pages.

---

## Step 1: Enable GitHub Pages

1. Go to: https://github.com/ton210/fidgetwidgets/settings/pages
2. Under **"Build and deployment"**:
   - Source: **Deploy from a branch**
   - Branch: **main**
   - Folder: **/ (root)**
3. Click **Save**
4. Wait 2-3 minutes for deployment

---

## Step 2: Configure DNS Records

Go to your domain registrar (where you bought fidget-widgets.com) and add these DNS records:

### DNS Records to Add:

#### For www.fidget-widgets.com:
```
Type: CNAME
Host: www
Value: ton210.github.io
TTL: Automatic or 3600
```

#### For fidget-widgets.com (redirect to www):
```
Type: A
Host: @
Value: 185.199.108.153

Type: A
Host: @
Value: 185.199.109.153

Type: A
Host: @
Value: 185.199.110.153

Type: A
Host: @
Value: 185.199.111.153
```

---

## Step 3: Domain Registrar-Specific Instructions

### If using **GoDaddy**:

1. Log into GoDaddy
2. Go to **My Products** > **Domains**
3. Click **DNS** next to fidget-widgets.com
4. Click **Add** to add new records:

   **For www subdomain:**
   - Type: `CNAME`
   - Name: `www`
   - Value: `ton210.github.io`
   - TTL: `1 Hour`

   **For root domain:**
   - Add 4 A records (one for each IP above)
   - Type: `A`
   - Name: `@`
   - Value: (use each IP from above)
   - TTL: `1 Hour`

5. Click **Save**

### If using **Namecheap**:

1. Log into Namecheap
2. Go to **Domain List** > **Manage** next to fidget-widgets.com
3. Click **Advanced DNS**
4. Add these records:

   | Type  | Host | Value                | TTL       |
   |-------|------|----------------------|-----------|
   | CNAME | www  | ton210.github.io     | Automatic |
   | A     | @    | 185.199.108.153      | Automatic |
   | A     | @    | 185.199.109.153      | Automatic |
   | A     | @    | 185.199.110.153      | Automatic |
   | A     | @    | 185.199.111.153      | Automatic |

5. Click **Save All Changes**

### If using **Cloudflare**:

1. Log into Cloudflare
2. Select fidget-widgets.com
3. Go to **DNS** > **Records**
4. Add records:

   | Type  | Name | Content              | Proxy Status     |
   |-------|------|----------------------|------------------|
   | CNAME | www  | ton210.github.io     | DNS only (gray)  |
   | A     | @    | 185.199.108.153      | DNS only (gray)  |
   | A     | @    | 185.199.109.153      | DNS only (gray)  |
   | A     | @    | 185.199.110.153      | DNS only (gray)  |
   | A     | @    | 185.199.111.153      | DNS only (gray)  |

   **Important**: Set Proxy Status to **DNS only** (gray cloud) for GitHub Pages

5. Click **Save**

---

## Step 4: Verify GitHub Pages Custom Domain

1. Go back to: https://github.com/ton210/fidgetwidgets/settings/pages
2. In the **Custom domain** section, you should see: `www.fidget-widgets.com`
3. If not, enter it and click **Save**
4. Wait for DNS check (green checkmark)
5. Enable **Enforce HTTPS** (after DNS propagates)

---

## Step 5: Wait for DNS Propagation

- **Time**: 15 minutes to 48 hours (usually 1-4 hours)
- **Check status**: Visit https://dnschecker.org and enter `www.fidget-widgets.com`

---

## Step 6: Test Your Site

After DNS propagates:

1. Visit **http://www.fidget-widgets.com** (should work)
2. Visit **http://fidget-widgets.com** (should redirect to www)
3. After HTTPS is enabled: **https://www.fidget-widgets.com** ✅

---

## Troubleshooting

### "This site can't be reached"
- **Cause**: DNS not propagated yet
- **Solution**: Wait longer (up to 48 hours max)

### "404 - There isn't a GitHub Pages site here"
- **Cause**: CNAME record not set correctly
- **Solution**: Double-check CNAME points to `ton210.github.io` (not `.com`)

### "Your connection is not private"
- **Cause**: HTTPS not enabled yet
- **Solution**: Wait for GitHub to provision SSL (10-20 minutes after DNS works)

### DNS Check Tool:
Visit https://dnschecker.org
- Enter: `www.fidget-widgets.com`
- Type: `CNAME`
- Should show: `ton210.github.io`

---

## Quick Checklist

- [ ] GitHub Pages enabled (main branch, root folder)
- [ ] CNAME file contains `www.fidget-widgets.com`
- [ ] DNS CNAME record: www → ton210.github.io
- [ ] DNS A records: @ → GitHub IPs (4 records)
- [ ] Custom domain configured in GitHub settings
- [ ] Waited for DNS propagation (15 min - 48 hrs)
- [ ] HTTPS enforced in GitHub Pages settings
- [ ] Tested www.fidget-widgets.com (works!)

---

## Final URLs

After setup completes:

- ✅ **https://www.fidget-widgets.com** (primary)
- ✅ **https://fidget-widgets.com** (redirects to www)
- ✅ **https://ton210.github.io/fidgetwidgets/** (still works as backup)

---

## Need Help?

- Check DNS: https://dnschecker.org
- GitHub Pages Docs: https://docs.github.com/en/pages
- Test propagation: https://www.whatsmydns.net/#CNAME/www.fidget-widgets.com

---

## What's On Your Site?

### Static HTML Version (GitHub Pages):
- ✅ Homepage with products
- ✅ Product images (17 AI-generated)
- ✅ Professional styling
- ✅ All 20 products displayed
- ❌ No shopping cart (needs PHP hosting)
- ❌ No checkout (needs PHP hosting)

### For Full E-commerce (Shopping Cart + Checkout):
You'll need PHP hosting. See DEPLOYMENT-OPTIONS.md for details.

---

**Current Status**: CNAME updated to www.fidget-widgets.com
**Next Step**: Configure DNS at your domain registrar
