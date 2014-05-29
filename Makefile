watch: generate
	chromium-browser presentation/index.html
	reflex -r "\.md$$" -- make generate

generate:
	rm -rf presentation/*
	remarkable remark presentation.md presentation/index
